<?php

namespace Grav\Plugin\VersionFallback;

use Grav\Common\Page\Page;

/**
 * A virtual page that represents a fallback from one version to another.
 *
 * The synthetic filesystem path points to the expected target version location
 * (which doesn't exist on disk), while media and content are loaded from the
 * source version's actual page.
 */
class VersionFallbackPage extends Page
{
    protected ?string $sourceMediaPath = null;
    protected ?string $sourceVersion = null;
    protected ?string $sourceRoute = null;

    /**
     * Set source page metadata for this fallback page.
     */
    public function setSourceInfo(string $mediaPath, string $version, string $route): void
    {
        $this->sourceMediaPath = $mediaPath;
        $this->sourceVersion = $version;
        $this->sourceRoute = $route;
    }

    /**
     * Media loads from the source page's directory, not the synthetic path.
     */
    public function getMediaFolder(): ?string
    {
        return $this->sourceMediaPath ?: parent::getMediaFolder();
    }

    /**
     * The synthetic path doesn't exist on disk, but the page is "real" in the page tree.
     */
    public function exists(): bool
    {
        return true;
    }

    public function getSourceVersion(): ?string
    {
        return $this->sourceVersion;
    }

    public function getSourceRoute(): ?string
    {
        return $this->sourceRoute;
    }
}
