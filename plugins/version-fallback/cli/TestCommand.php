<?php

namespace Grav\Plugin\Console;

use Grav\Common\Grav;
use Grav\Common\Page\Pages;
use Grav\Console\ConsoleCommand;
use Grav\Plugin\VersionFallback\VersionFallbackPage;

class TestCommand extends ConsoleCommand
{
    protected function configure(): void
    {
        $this
            ->setName('test')
            ->setDescription('Test version fallback augmentation')
            ->setHelp('Initializes pages and reports on virtual fallback pages created');
    }

    protected function serve(): int
    {
        require_once dirname(__DIR__) . '/classes/VersionFallbackPage.php';

        $this->initializePages();

        $io = $this->output;
        $grav = Grav::instance();
        $errors = 0;

        /** @var Pages $pages */
        $pages = $grav['pages'];

        $io->title('Version Fallback Plugin - Test Report');

        // Check plugin config
        $fallbackConfig = (array)$grav['config']->get('plugins.version-fallback.fallback', []);
        if (empty($fallbackConfig)) {
            $io->error('No fallback configuration found. Check plugins.version-fallback.fallback');
            return 1;
        }

        $io->section('1. Configuration');
        foreach ($fallbackConfig as $target => $sources) {
            $io->text("Version <info>{$target}</info> falls back to: <info>" . implode(', ', (array)$sources) . "</info>");
        }

        // Count pages per version
        $io->section('2. Page Counts');
        $allRoutes = $pages->routes();

        foreach ($fallbackConfig as $targetVersion => $sourceVersions) {
            $targetPrefix = '/' . $targetVersion;
            $targetRoutes = array_filter(array_keys($allRoutes), function ($r) use ($targetPrefix) {
                return str_starts_with($r, $targetPrefix . '/') || $r === $targetPrefix;
            });

            foreach ((array)$sourceVersions as $sv) {
                $sourcePrefix = '/' . $sv;
                $sourceRoutes = array_filter(array_keys($allRoutes), function ($r) use ($sourcePrefix) {
                    return str_starts_with($r, $sourcePrefix . '/') || $r === $sourcePrefix;
                });
                $io->text("/{$sv} pages: <info>" . count($sourceRoutes) . "</info>");
            }

            $io->text("/{$targetVersion} pages (after augmentation): <info>" . count($targetRoutes) . "</info>");

            if (count($targetRoutes) < 10) {
                $io->error("Expected at least ~187 pages for /{$targetVersion}, got " . count($targetRoutes));
                $errors++;
            }
        }

        // Test: Real pages take precedence
        $io->section('3. Real Page Precedence');
        $realPage = $pages->find('/18/basics/installation');
        if ($realPage) {
            $header = $realPage->header();
            $isFallback = $header->version_fallback ?? false;
            if ($isFallback) {
                $io->error('/18/basics/installation should be REAL but is marked as fallback');
                $errors++;
            } else {
                $io->text('/18/basics/installation: <info>correctly real (not a fallback)</info>');
            }
        } else {
            $io->error('/18/basics/installation: NOT FOUND');
            $errors++;
        }

        // Test: Fallback pages exist
        $io->section('4. Fallback Pages Exist');
        $fallbackRoutes = [
            '/18/content',
            '/18/content/headers',
            '/18/themes',
            '/18/plugins',
            '/18/advanced',
            '/18/cli-console',
            '/18/forms',
            '/18/admin-panel',
            '/18/cookbook',
            '/18/troubleshooting',
            '/18/migration',
            '/18/security',
            '/18/hints-tips',
            '/18/webservers-hosting',
        ];
        foreach ($fallbackRoutes as $route) {
            $page = $pages->find($route);
            if ($page) {
                $header = $page->header();
                $isFallback = $header->version_fallback ?? false;
                if ($isFallback) {
                    $io->text("  {$route}: <info>OK (fallback from {$header->version_fallback_source})</info>");
                } else {
                    $io->text("  {$route}: <comment>real page (not a fallback)</comment>");
                }
            } else {
                $io->error("  {$route}: NOT FOUND");
                $errors++;
            }
        }

        // Test: Parent chains
        $io->section('5. Parent Chain Integrity');
        $testPages = ['/18/content/headers', '/18/advanced/debugging', '/18/cookbook/tutorials/create-a-blog'];
        foreach ($testPages as $route) {
            $page = $pages->find($route);
            if (!$page) {
                $io->error("  {$route}: NOT FOUND");
                $errors++;
                continue;
            }

            $chain = [];
            $current = $page;
            $depth = 0;
            while ($current && $depth < 10) {
                $chain[] = $current->route() ?: '/';
                $current = $current->parent();
                $depth++;
            }
            $chainStr = implode(' -> ', array_reverse($chain));
            $io->text("  {$route}: {$chainStr}");

            // Verify chain reaches /18 root
            if (!in_array('/18', $chain)) {
                $io->error("    Parent chain does not reach /18 root!");
                $errors++;
            }
        }

        // Test: Content rendering
        $io->section('6. Content Rendering');
        $contentPage = $pages->find('/18/content/headers');
        if ($contentPage) {
            try {
                $content = $contentPage->content();
                $contentLen = strlen($content);
                if ($contentLen > 100) {
                    $io->text("  /18/content/headers content: <info>{$contentLen} chars rendered OK</info>");
                    // Check it contains expected HTML
                    if (str_contains($content, 'Frontmatter') || str_contains($content, 'Header')) {
                        $io->text("  Content contains expected keywords: <info>OK</info>");
                    } else {
                        $io->error("  Content does not contain expected keywords!");
                        $errors++;
                    }
                } else {
                    $io->error("  Content too short ({$contentLen} chars)");
                    $errors++;
                }
            } catch (\Throwable $e) {
                $io->error("  Content rendering failed: " . $e->getMessage());
                $errors++;
            }
        }

        // Test: VersionFallbackPage class
        $io->section('7. VersionFallbackPage Type Check');
        $fbPage = $pages->find('/18/content/headers');
        if ($fbPage instanceof VersionFallbackPage) {
            $io->text("  /18/content/headers: <info>is VersionFallbackPage</info>");
            $io->text("    sourceVersion: <info>" . ($fbPage->getSourceVersion() ?? 'null') . "</info>");
            $io->text("    sourceRoute: <info>" . ($fbPage->getSourceRoute() ?? 'null') . "</info>");
            $io->text("    mediaFolder: <info>" . ($fbPage->getMediaFolder() ?? 'null') . "</info>");
            $io->text("    exists(): <info>" . ($fbPage->exists() ? 'true' : 'false') . "</info>");
        } else {
            $io->text("  /18/content/headers: <comment>not a VersionFallbackPage (class: " . get_class($fbPage) . ")</comment>");
        }

        // Test: Media folder points to source version
        $io->section('8. Media Folder Resolution');
        $fbPageMedia = $pages->find('/18/content/media');
        if ($fbPageMedia instanceof VersionFallbackPage) {
            $mediaFolder = $fbPageMedia->getMediaFolder();
            if ($mediaFolder && str_contains($mediaFolder, '/17/')) {
                $io->text("  /18/content/media mediaFolder: <info>correctly points to v17 ({$mediaFolder})</info>");
            } else {
                $io->error("  /18/content/media mediaFolder does not point to v17: {$mediaFolder}");
                $errors++;
            }
        } else {
            $io->text("  /18/content/media: <comment>not a VersionFallbackPage, skipping media check</comment>");
        }

        // Test: URL generation
        $io->section('9. URL Generation');
        $urlPage = $pages->find('/18/content/headers');
        if ($urlPage) {
            $url = $urlPage->url();
            if (str_contains($url, '/18/') && str_contains($url, 'headers')) {
                $io->text("  /18/content/headers url(): <info>{$url}</info>");
            } else {
                $io->error("  URL doesn't contain expected path: {$url}");
                $errors++;
            }
        }

        // Test: Navigation tree for v18 matches v17
        $io->section('10. Navigation Tree Parity');
        $v17Root = $pages->find('/17');
        $v18Root = $pages->find('/18');
        if ($v17Root && $v18Root) {
            $v17Children = [];
            foreach ($v17Root->children()->visible() as $child) {
                $slug = $child->slug();
                $v17Children[$slug] = $child->children()->count();
            }
            $v18Children = [];
            foreach ($v18Root->children()->visible() as $child) {
                $slug = $child->slug();
                $v18Children[$slug] = $child->children()->count();
            }

            $missingInV18 = array_diff_key($v17Children, $v18Children);
            if (empty($missingInV18)) {
                $io->text("  All v17 top-level categories present in v18: <info>OK</info>");
            } else {
                $io->error("  Missing from v18: " . implode(', ', array_keys($missingInV18)));
                $errors++;
            }

            // Check child counts match
            $mismatch = false;
            foreach ($v17Children as $slug => $count) {
                $v18Count = $v18Children[$slug] ?? 0;
                if ($v18Count !== $count) {
                    $io->text("  <comment>{$slug}: v17={$count} vs v18={$v18Count}</comment>");
                    $mismatch = true;
                }
            }
            if (!$mismatch) {
                $io->text("  Children counts match between v17 and v18: <info>OK</info>");
            }
        }

        // Summary
        $io->newLine();
        if ($errors === 0) {
            $io->success("All tests passed!");
        } else {
            $io->error("{$errors} test(s) failed");
        }

        return $errors > 0 ? 1 : 0;
    }
}
