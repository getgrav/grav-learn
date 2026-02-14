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
        $debug = [];
        $debug[] = '=== VF DEBUG ' . date('Y-m-d H:i:s') . ' SAPI=' . php_sapi_name() . ' ===';

        $fallbackConfig = (array)$this->config->get('plugins.version-fallback.fallback', []);
        if (empty($fallbackConfig)) {
            $debug[] = 'EARLY EXIT: empty fallbackConfig';
            $this->writeDebugLog($debug);
            return;
        }

        $debug[] = 'fallbackConfig: ' . json_encode($fallbackConfig);

        /** @var Pages $pages */
        $pages = $this->grav['pages'];

        $suppressConfig = (array)$this->config->get('plugins.version-fallback.suppress', []);

        // Check plugin-level cache
        $cache = $this->grav['cache'];
        $pagesHash = $pages->getPagesCacheId();
        $cacheKey = 'version-fallback-' . md5($pagesHash . json_encode($fallbackConfig) . json_encode($suppressConfig));
        $cachedMap = $cache->fetch($cacheKey);

        $debug[] = 'pagesHash: ' . $pagesHash;
        $debug[] = 'cacheKey: ' . $cacheKey;
        $debug[] = 'cachedMap type: ' . gettype($cachedMap) . ' count: ' . (is_array($cachedMap) ? count($cachedMap) : 'N/A');

        if (is_array($cachedMap) && !empty($cachedMap)) {
            $debug[] = 'CACHE HIT - calling rebuildFromCache with ' . count($cachedMap) . ' entries';
            $this->rebuildFromCache($cachedMap, $pages, $fallbackConfig);

            // Verify after rebuild
            $page18 = $pages->find('/18');
            if ($page18) {
                $children = $page18->children();
                $debug[] = 'After rebuild: /18 children count=' . $children->count();
                $debug[] = 'After rebuild: /18 visible children count=' . $page18->children()->visible()->count();
                $debug[] = '/18 path()=' . $page18->path();
            } else {
                $debug[] = 'After rebuild: /18 NOT FOUND';
            }
            $debug[] = 'fallbackMap count: ' . count($this->fallbackMap);
            $debug[] = 'Pages spl_object_id=' . spl_object_id($pages);

            $this->writeDebugLog($debug);
            return;
        }

        $debug[] = 'CACHE MISS - building fresh';
        $this->fallbackMap = [];

        foreach ($fallbackConfig as $targetVersion => $sourceVersions) {
            $targetVersion = (string)$targetVersion;
            $sourceVersions = (array)$sourceVersions;
            $suppressedRoutes = (array)($suppressConfig[$targetVersion] ?? []);

            foreach ($sourceVersions as $sourceVersion) {
                $sourceVersion = (string)$sourceVersion;
                $sourceRoot = $pages->find('/' . $sourceVersion);

                if (!$sourceRoot) {
                    $debug[] = "sourceRoot /$sourceVersion: NOT FOUND";
                    continue;
                }

                $debug[] = "sourceRoot /$sourceVersion: FOUND path=" . $sourceRoot->path() . " children=" . $sourceRoot->children()->count();

                $targetRoot = $pages->find('/' . $targetVersion);
                $debug[] = "targetRoot /$targetVersion: " . ($targetRoot ? 'FOUND path=' . $targetRoot->path() . ' children=' . $targetRoot->children()->count() : 'NOT FOUND');

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

        $debug[] = 'After augment: fallbackMap count=' . count($this->fallbackMap);

        // Verify /18 children after augment
        $page18 = $pages->find('/18');
        if ($page18) {
            $debug[] = 'After augment: /18 children count=' . $page18->children()->count();
            $debug[] = 'After augment: /18 visible children count=' . $page18->children()->visible()->count();
            foreach ($page18->children() as $child) {
                $debug[] = '  child: ' . $child->route() . ' class=' . get_class($child) . ' visible=' . ($child->visible() ? 'Y' : 'N');
            }
        }

        $debug[] = 'Pages spl_object_id=' . spl_object_id($pages);

        // Cache the fallback map
        if (!empty($this->fallbackMap)) {
            $cache->save($cacheKey, $this->fallbackMap, 604800); // 1 week, invalidates via pagesHash
        }

        $this->writeDebugLog($debug);
    }

    protected function writeDebugLog(array $lines): void
    {
        $logDir = $this->grav['locator']->findResource('log://');
        if ($logDir) {
            file_put_contents($logDir . '/vf-debug.log', implode("\n", $lines) . "\n\n", FILE_APPEND);
        }
    }

    /**
     * Recursively walk source page tree and create virtual pages for missing target pages.
     */
    protected function recursiveAugment(
        Pages $pages,
        PageInterface $sourceParent,
        ?PageInterface $targetParent,
        string $sourceVersion,
        string $targetVersion,
        array $suppressedRoutes
    ): void {
        foreach ($sourceParent->children() as $sourceChild) {
            $sourceRoute = $sourceChild->rawRoute();

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

            if (!$existingTarget) {
                // Create virtual page
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
     * Rebuild virtual pages from cached fallback map.
     */
    protected function rebuildFromCache(array $cachedMap, Pages $pages, array $fallbackConfig): void
    {
        $debug = [];
        $debug[] = 'rebuildFromCache: ' . count($cachedMap) . ' entries';
        $skippedExists = 0;
        $skippedNoSource = 0;
        $skippedNoConfig = 0;
        $skippedNoVirtual = 0;
        $created = 0;

        // Sort by route depth to ensure parents are created before children
        uksort($cachedMap, function ($a, $b) {
            return substr_count($a, '/') <=> substr_count($b, '/');
        });

        foreach ($cachedMap as $targetRoute => $sourceRoute) {
            // Skip if target already exists (real page was added since cache was built)
            if ($pages->find($targetRoute)) {
                $skippedExists++;
                continue;
            }

            $sourcePage = $pages->find($sourceRoute);
            if (!$sourcePage) {
                $skippedNoSource++;
                if ($skippedNoSource <= 5) {
                    $debug[] = "  NO SOURCE: $sourceRoute (target: $targetRoute)";
                }
                continue;
            }

            // Extract target version from route
            $segments = explode('/', trim($targetRoute, '/'));
            $targetVersion = $segments[0] ?? '';

            if (!isset($fallbackConfig[$targetVersion])) {
                $skippedNoConfig++;
                continue;
            }

            $virtualPage = $this->createVirtualPage($pages, $sourcePage, $targetVersion, $targetRoute);
            if ($virtualPage) {
                $pages->addPage($virtualPage, $targetRoute);
                $created++;
            } else {
                $skippedNoVirtual++;
            }
        }

        $debug[] = "Results: created=$created skippedExists=$skippedExists skippedNoSource=$skippedNoSource skippedNoConfig=$skippedNoConfig skippedNoVirtual=$skippedNoVirtual";

        $this->fallbackMap = $cachedMap;

        $logDir = $this->grav['locator']->findResource('log://');
        if ($logDir) {
            file_put_contents($logDir . '/vf-debug.log', implode("\n", $debug) . "\n", FILE_APPEND);
        }
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
