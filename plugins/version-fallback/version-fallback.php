<?php

namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Plugin\VersionFallback\VersionFallbackPage;
use RocketTheme\Toolbox\Event\Event;

class VersionFallbackPlugin extends Plugin
{
    /** @var array Cached fallback map: [targetRoute => sourceRoute, ...] */
    protected array $fallbackMap = [];

    /** @var array Routes explicitly removed in target versions */
    protected array $removedRoutes = [];

    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized(): void
    {
        // Don't run in admin context unless configured
        if ($this->isAdmin() && !$this->config->get('plugins.version-fallback.admin_pages', false)) {
            return;
        }

        require_once __DIR__ . '/classes/VersionFallbackPage.php';

        $this->enable([
            'onPagesInitialized' => ['onPagesInitialized', 0],
            'onPageNotFound'     => ['onPageNotFound', 5],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
        ]);
    }

    /**
     * Main augmentation: walk source version trees and create virtual pages for missing target pages.
     */
    public function onPagesInitialized(Event $event): void
    {
        $fallbackConfig = (array)$this->config->get('plugins.version-fallback.fallback', []);
        if (empty($fallbackConfig)) {
            return;
        }

        /** @var Pages $pages */
        $pages = $this->grav['pages'];

        $suppressConfig = (array)$this->config->get('plugins.version-fallback.suppress', []);

        // Check plugin-level cache
        $cache = $this->grav['cache'];
        $pagesHash = $pages->getPagesCacheId();
        $cacheKey = 'version-fallback-' . md5($pagesHash . json_encode($fallbackConfig) . json_encode($suppressConfig));
        $cachedData = $cache->fetch($cacheKey);

        if (is_array($cachedData) && !empty($cachedData)) {
            $this->rebuildFromCache($cachedData, $pages, $fallbackConfig);
            $this->fixChildParentReferences($pages);
            foreach ($fallbackConfig as $tv => $sv) {
                $this->sortVersionChildren($pages, (string)$tv);
            }
            return;
        }

        $this->fallbackMap = [];
        $this->removedRoutes = [];

        foreach ($fallbackConfig as $targetVersion => $sourceVersions) {
            $targetVersion = (string)$targetVersion;
            $sourceVersions = (array)$sourceVersions;
            $suppressedRoutes = (array)($suppressConfig[$targetVersion] ?? []);

            foreach ($sourceVersions as $sourceVersion) {
                $sourceVersion = (string)$sourceVersion;
                $sourceRoot = $pages->find('/' . $sourceVersion);

                if (!$sourceRoot) {
                    continue;
                }

                $targetRoot = $pages->find('/' . $targetVersion);

                $this->recursiveAugment(
                    $pages,
                    $sourceRoot,
                    $targetRoot,
                    $sourceVersion,
                    $targetVersion,
                    $suppressedRoutes
                );
            }
        }

        // Fix parent references for real pages whose parent route now points
        // to a virtual page created above
        $this->fixChildParentReferences($pages);

        // Re-sort children for target versions. After the merge, the children
        // array mixes real pages (from filesystem scan) with virtual pages (appended
        // later), so the insertion order no longer matches the numeric folder order.
        foreach ($fallbackConfig as $targetVersion => $sourceVersions) {
            $this->sortVersionChildren($pages, (string)$targetVersion);
        }

        // Cache the fallback map and removed routes
        if (!empty($this->fallbackMap) || !empty($this->removedRoutes)) {
            $cache->save($cacheKey, [
                'fallbackMap' => $this->fallbackMap,
                'removedRoutes' => $this->removedRoutes,
            ], 604800); // 1 week, invalidates via pagesHash
        }
    }

    /**
     * Recursively walk source page tree and merge with target page tree.
     * Creates virtual pages for missing targets, upgrades bare folder pages
     * with source content, and handles removed page markers.
     */
    protected function recursiveAugment(
        Pages $pages,
        PageInterface $sourceParent,
        ?PageInterface $targetParent,
        string $sourceVersion,
        string $targetVersion,
        array $suppressedRoutes
    ): void {
        // Track which slugs we process from source, so we can handle target-only children after
        $processedSlugs = [];

        foreach ($sourceParent->children() as $sourceChild) {
            $sourceRoute = $sourceChild->rawRoute();
            $processedSlugs[] = $sourceChild->slug();

            // Build expected target route by replacing version prefix
            // Use rawRoute() to avoid home alias corrupting the path
            $relativePath = substr($sourceRoute, strlen('/' . $sourceVersion));
            $targetRoute = '/' . $targetVersion . $relativePath;

            // Check suppression: page-level frontmatter
            $sourceHeader = $sourceChild->header();
            if (isset($sourceHeader->version_exclude)) {
                $excludeVersions = (array)$sourceHeader->version_exclude;
                if (in_array($targetVersion, $excludeVersions)) {
                    continue;
                }
            }

            // Check suppression: plugin config
            if ($this->isRouteSuppressed($relativePath, $suppressedRoutes)) {
                continue;
            }

            // Check if target page already exists
            $existingTarget = $pages->find($targetRoute);

            if ($existingTarget) {
                // Check for "removed" marker — page explicitly removed in target version
                $targetHeader = $existingTarget->header();
                if (!empty($targetHeader->version_removed) || $existingTarget->template() === 'removed') {
                    $existingTarget->routable(false);
                    $existingTarget->visible(false);
                    $existingTarget->published(false);
                    $this->removedRoutes[] = $targetRoute;
                    // Don't recurse — removal cascades to children
                    continue;
                }

                // If target is a bare folder page (no content file on disk) but source
                // has real content, upgrade the bare page in-place with source content.
                // This happens when e.g. v18 has a folder with children but no chapter.md.
                // We must upgrade in-place because Pages::addPage() won't overwrite an
                // existing page at the same filesystem path ($this->index[$path] check).
                if ($this->isBarePage($existingTarget) && $sourceChild->routable()) {
                    $this->upgradeBarePage($existingTarget, $sourceChild, $this->extractVersionFromPath($sourceChild));
                    $this->fallbackMap[$targetRoute] = $sourceRoute;
                }
            } else {
                // No target page exists — create virtual page from source
                $virtualPage = $this->createVirtualPage(
                    $pages,
                    $sourceChild,
                    $targetVersion,
                    $targetRoute
                );

                if ($virtualPage) {
                    $pages->addPage($virtualPage, $targetRoute);
                    $this->fallbackMap[$targetRoute] = $sourceRoute;
                    // Use the newly created virtual page as the target parent for recursion
                    $existingTarget = $virtualPage;
                }
            }

            // Recurse into children regardless (target may have parent but not grandchildren)
            if ($existingTarget) {
                $this->recursiveAugment(
                    $pages,
                    $sourceChild,
                    $existingTarget,
                    $sourceVersion,
                    $targetVersion,
                    $suppressedRoutes
                );
            }
        }

        // Handle target-only children: pages that exist in target but not in source.
        // These are already in the page tree from Grav's filesystem scan.
        // We still need to check for removed markers on them.
        if ($targetParent) {
            foreach ($targetParent->children() as $targetChild) {
                if (in_array($targetChild->slug(), $processedSlugs)) {
                    continue; // Already handled above
                }

                $targetHeader = $targetChild->header();
                if (!empty($targetHeader->version_removed) || $targetChild->template() === 'removed') {
                    $targetChild->routable(false);
                    $targetChild->visible(false);
                    $targetChild->published(false);
                    $this->removedRoutes[] = $targetChild->rawRoute();
                }
            }
        }
    }

    /**
     * Check if a page is a "bare" folder page with no content file on disk.
     * These are created by Grav when a directory has child pages but no markdown file.
     */
    protected function isBarePage(PageInterface $page): bool
    {
        if ($page instanceof VersionFallbackPage) {
            return false;
        }

        $filePath = $page->filePath();
        return !$filePath || !file_exists($filePath);
    }

    /**
     * Upgrade a bare folder page in-place with content from a source page.
     * This modifies the existing page object directly rather than replacing it,
     * because Pages::addPage() won't overwrite an existing page at the same
     * filesystem path (it checks $this->index[$path]).
     */
    protected function upgradeBarePage(PageInterface $targetPage, PageInterface $sourcePage, ?string $sourceVersion): void
    {
        $targetPage->name($sourcePage->name());
        $targetPage->template($sourcePage->template());
        $targetPage->visible($sourcePage->visible());
        $targetPage->routable($sourcePage->routable());
        $targetPage->published($sourcePage->published());
        $targetPage->modularTwig($sourcePage->modularTwig());
        $targetPage->extension($sourcePage->extension());

        // Copy header with fallback metadata
        $sourceHeader = (array)$sourcePage->header();
        $sourceHeader['version_fallback'] = true;
        $sourceHeader['version_fallback_source'] = $sourceVersion;
        $targetPage->header((object)$sourceHeader);

        // Set content from source
        $rawContent = $sourcePage->rawMarkdown();
        if ($rawContent !== null) {
            $targetPage->rawMarkdown($rawContent);
        }

        $targetPage->process($sourcePage->process());
        $targetPage->modified($sourcePage->modified());
        $targetPage->date($sourcePage->date());
    }

    /**
     * Fix parent references for real pages whose parent route now points to a
     * virtual page. Grav sets parent references during page initialization
     * (before the fallback plugin runs), so they can become stale when we
     * replace a bare folder with a virtual page.
     */
    protected function fixChildParentReferences(Pages $pages): void
    {
        if (empty($this->fallbackMap)) {
            return;
        }

        $allRoutes = $pages->routes();

        foreach ($this->fallbackMap as $virtualRoute => $sourceRoute) {
            $virtualPage = $pages->find($virtualRoute);
            if (!$virtualPage) {
                continue;
            }

            // Find direct children of this virtual page's route
            $prefix = $virtualRoute . '/';
            foreach ($allRoutes as $route => $path) {
                if (!str_starts_with($route, $prefix)) {
                    continue;
                }
                // Only direct children (no additional path segments)
                $remaining = substr($route, strlen($prefix));
                if (str_contains($remaining, '/')) {
                    continue;
                }

                $childPage = $pages->find($route);
                if ($childPage && !($childPage instanceof VersionFallbackPage)) {
                    // Real page — update parent to the virtual page
                    $childPage->parent($virtualPage);
                }
            }
        }
    }

    /**
     * Re-sort children at all levels for a target version.
     * After the merge, the Pages::$children array mixes real pages (from
     * filesystem scan) with virtual pages (appended by addPage). The insertion
     * order no longer matches the numeric folder prefix order, so we re-sort
     * using natural comparison on folder names (e.g. 01.basics < 04.plugins).
     */
    protected function sortVersionChildren(Pages $pages, string $targetVersion): void
    {
        $targetRoot = $pages->find('/' . $targetVersion);
        if (!$targetRoot || !$targetRoot->path()) {
            return;
        }

        $reflection = new \ReflectionProperty(get_class($pages), 'children');
        $reflection->setAccessible(true);
        $children = $reflection->getValue($pages);

        $this->recursiveSortChildren($children, $targetRoot->path());

        $reflection->setValue($pages, $children);
    }

    /**
     * Recursively sort children arrays by folder name (natural order).
     */
    protected function recursiveSortChildren(array &$children, string $parentPath): void
    {
        if (!isset($children[$parentPath])) {
            return;
        }

        uksort($children[$parentPath], function ($a, $b) {
            return strnatcasecmp(basename($a), basename($b));
        });

        foreach ($children[$parentPath] as $childPath => $data) {
            $this->recursiveSortChildren($children, $childPath);
        }
    }

    /**
     * Create a VersionFallbackPage from a source page.
     */
    protected function createVirtualPage(
        Pages $pages,
        PageInterface $sourcePage,
        string $targetVersion,
        string $targetRoute
    ): ?VersionFallbackPage {
        $virtualPage = new VersionFallbackPage();

        // Build synthetic filesystem path
        // Source path e.g.: /path/to/pages/17/02.content/02.headers
        // Target path e.g.: /path/to/pages/18/02.content/02.headers
        $sourcePath = $sourcePage->path();
        $sourceVersion = $this->extractVersionFromPath($sourcePage);

        if (!$sourceVersion || !$sourcePath) {
            return null;
        }

        // Replace the version segment in the filesystem path
        $pagesDir = $this->grav['locator']->findResource('page://');
        $relativeFromPages = substr($sourcePath, strlen($pagesDir));
        // Replace /17/ (or /sourceVersion/) with /targetVersion/
        $targetRelative = preg_replace(
            '#^/' . preg_quote($sourceVersion, '#') . '/#',
            '/' . $targetVersion . '/',
            $relativeFromPages
        );
        $syntheticPath = $pagesDir . $targetRelative;

        // Set the synthetic filesystem path components
        // path() returns $this->path . '/' . $this->folder
        // filePath() sets: name (basename), folder (parent basename), path (dirname of dirname)
        $syntheticFilePath = $syntheticPath . '/' . $sourcePage->name();
        $virtualPage->filePath($syntheticFilePath);

        // Set basic page properties
        $virtualPage->name($sourcePage->name());
        $virtualPage->template($sourcePage->template());
        $virtualPage->visible($sourcePage->visible());
        $virtualPage->routable($sourcePage->routable());
        $virtualPage->published($sourcePage->published());
        $virtualPage->slug($sourcePage->slug());
        $virtualPage->route($targetRoute);
        $virtualPage->rawRoute($targetRoute);
        $virtualPage->modularTwig($sourcePage->modularTwig());
        $virtualPage->extension($sourcePage->extension());

        // Copy header and add fallback metadata
        $sourceHeader = (array)$sourcePage->header();
        $sourceHeader['version_fallback'] = true;
        $sourceHeader['version_fallback_source'] = $sourceVersion;
        $virtualPage->header((object)$sourceHeader);

        // Set raw markdown content from source
        $rawContent = $sourcePage->rawMarkdown();
        if ($rawContent !== null) {
            $virtualPage->rawMarkdown($rawContent);
        }

        // Set process flags from source
        $virtualPage->process($sourcePage->process());

        // Set modified time from source
        $virtualPage->modified($sourcePage->modified());
        $virtualPage->date($sourcePage->date());

        // Set source info for media resolution
        $virtualPage->setSourceInfo(
            $sourcePage->path(),
            $sourceVersion,
            $sourcePage->rawRoute()
        );

        // Set parent to the target version's parent page
        $parentRoute = dirname($targetRoute);
        if ($parentRoute === '/' || $parentRoute === $targetRoute) {
            // Top-level pages under a version root: parent is the version root page
            $parentRoute = '/' . $targetVersion;
        }
        // Don't set self as parent
        if ($parentRoute !== $targetRoute) {
            $parentPage = $pages->find($parentRoute);
            if ($parentPage) {
                $virtualPage->parent($parentPage);
            }
        }

        return $virtualPage;
    }

    /**
     * Safety net: catch 404s for versioned routes and serve fallback pages.
     * Priority 5 (before Helios onPageNotFound at 10).
     */
    public function onPageNotFound(Event $event): void
    {
        $fallbackConfig = (array)$this->config->get('plugins.version-fallback.fallback', []);
        if (empty($fallbackConfig)) {
            return;
        }

        $uri = $this->grav['uri'];
        $route = $uri->route();

        if (empty($route) || $route === '/') {
            return;
        }

        // Try to extract version from route
        $segments = explode('/', trim($route, '/'));
        $potentialVersion = $segments[0] ?? '';

        if (!isset($fallbackConfig[$potentialVersion])) {
            return;
        }

        // Check if this route is explicitly removed in the target version
        if (in_array($route, $this->removedRoutes)) {
            return; // Let the 404 stand
        }

        $targetVersion = $potentialVersion;
        $sourceVersions = (array)$fallbackConfig[$targetVersion];
        $remainingSegments = array_slice($segments, 1);
        $relativePath = $remainingSegments ? '/' . implode('/', $remainingSegments) : '';

        /** @var Pages $pages */
        $pages = $this->grav['pages'];
        $suppressConfig = (array)$this->config->get('plugins.version-fallback.suppress', []);
        $suppressedRoutes = (array)($suppressConfig[$targetVersion] ?? []);

        foreach ($sourceVersions as $sourceVersion) {
            $sourceVersion = (string)$sourceVersion;
            $sourceRoute = '/' . $sourceVersion . $relativePath;
            $sourcePage = $pages->find($sourceRoute);

            if (!$sourcePage || !$sourcePage->routable()) {
                continue;
            }

            // Check suppression
            $sourceHeader = $sourcePage->header();
            if (isset($sourceHeader->version_exclude)) {
                $excludeVersions = (array)$sourceHeader->version_exclude;
                if (in_array($targetVersion, $excludeVersions)) {
                    continue;
                }
            }
            if ($this->isRouteSuppressed($relativePath, $suppressedRoutes)) {
                continue;
            }

            // Create one-off virtual page
            $virtualPage = $this->createVirtualPage(
                $pages,
                $sourcePage,
                $targetVersion,
                $route
            );

            if ($virtualPage) {
                $event->page = $virtualPage;
                $event->stopPropagation();
                return;
            }
        }
    }

    /**
     * Register the [version] shortcode.
     */
    public function onShortcodeHandlers(): void
    {
        $shortcode = $this->grav['shortcode'];
        $grav = $this->grav;

        $shortcode->getHandlers()->add('version', function ($sc) use ($grav) {
            // Get the target versions from the shortcode parameter
            // Usage: [version=17]content[/version] or [version="17,18"]content[/version]
            $targetVersions = $sc->getParameter('version') ?: $sc->getParameter(0, '');
            $targetVersions = array_map('trim', explode(',', (string)$targetVersions));

            // Detect current version from the page route
            $page = $grav['page'] ?? null;
            $currentVersion = null;

            if ($page) {
                $route = $page->route() ?? '';
                $segments = explode('/', trim($route, '/'));
                $currentVersion = $segments[0] ?? null;
            }

            if ($currentVersion && in_array($currentVersion, $targetVersions, true)) {
                return $sc->getContent();
            }

            return '';
        });
    }

    /**
     * Rebuild virtual pages from cached data.
     */
    protected function rebuildFromCache(array $cachedData, Pages $pages, array $fallbackConfig): void
    {
        // Support both old format (just fallback map) and new format (with removedRoutes)
        if (isset($cachedData['fallbackMap'])) {
            $cachedMap = $cachedData['fallbackMap'];
            $removedRoutes = $cachedData['removedRoutes'] ?? [];
        } else {
            // Legacy format: the data IS the fallback map
            $cachedMap = $cachedData;
            $removedRoutes = [];
        }

        // Sort by route depth to ensure parents are created before children
        uksort($cachedMap, function ($a, $b) {
            return substr_count($a, '/') <=> substr_count($b, '/');
        });

        foreach ($cachedMap as $targetRoute => $sourceRoute) {
            $existingTarget = $pages->find($targetRoute);
            $sourcePage = $pages->find($sourceRoute);

            if (!$sourcePage) {
                continue;
            }

            // Extract target version from route
            $segments = explode('/', trim($targetRoute, '/'));
            $targetVersion = $segments[0] ?? '';

            if (!isset($fallbackConfig[$targetVersion])) {
                continue;
            }

            if ($existingTarget) {
                // If target is a bare folder page, upgrade it in-place with source content
                if ($this->isBarePage($existingTarget)) {
                    $sourceVersion = $this->extractVersionFromPath($sourcePage);
                    $this->upgradeBarePage($existingTarget, $sourcePage, $sourceVersion);
                }
                continue;
            }

            $virtualPage = $this->createVirtualPage($pages, $sourcePage, $targetVersion, $targetRoute);
            if ($virtualPage) {
                $pages->addPage($virtualPage, $targetRoute);
            }
        }

        // Apply removed routes
        foreach ($removedRoutes as $route) {
            $page = $pages->find($route);
            if ($page) {
                $page->routable(false);
                $page->visible(false);
                $page->published(false);
            }
        }

        $this->fallbackMap = $cachedMap;
        $this->removedRoutes = $removedRoutes;
    }

    /**
     * Check if a relative route is suppressed.
     */
    protected function isRouteSuppressed(string $relativePath, array $suppressedRoutes): bool
    {
        foreach ($suppressedRoutes as $suppressed) {
            $suppressed = (string)$suppressed;
            if ($relativePath === $suppressed || str_starts_with($relativePath, $suppressed . '/')) {
                return true;
            }
        }
        return false;
    }

    /**
     * Extract the version identifier from a page's filesystem path.
     */
    protected function extractVersionFromPath(PageInterface $page): ?string
    {
        $path = $page->path();
        $pagesDir = $this->grav['locator']->findResource('page://');

        if (!$path || !$pagesDir) {
            return null;
        }

        $relPath = substr($path, strlen($pagesDir));
        $segments = explode('/', trim($relPath, '/'));

        return $segments[0] ?? null;
    }
}
