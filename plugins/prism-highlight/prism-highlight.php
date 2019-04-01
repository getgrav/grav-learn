<?php

namespace Grav\Plugin;

use Grav\Common\Inflector;
use \Grav\Common\Plugin;
use \Grav\Common\Page\Page;

class PrismHighlightPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPageInitialized' => ['onPageInitialized', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPageInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $defaults = (array)$this->config->get('plugins.prism-highlight');

        /** @var Page $page */
        $page = $this->grav['page'];
        if (isset($page->header()->prism)) {
            $this->config->set('plugins.prism-highlight', array_merge($defaults, $page->header()->prism));
        }
        if ($this->config->get('plugins.prism-highlight.enabled')) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        }

    }

    /**
     * Initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * if enabled on this page, load the JS + CSS theme.
     */
    public function onTwigSiteVariables()
    {
        $theme = $this->config->get('plugins.prism-highlight.theme') ?: 'prism-default.css';
        $this->grav['assets']->addCss('plugin://prism-highlight/css/prism.css');
        $this->grav['assets']->addCss('plugin://prism-highlight/css/' . $theme);
        $this->grav['assets']->addJs('plugin://prism-highlight/js/prism.js', null, true, null, 'bottom');

        $inline = '';

        // Always add at least plain text language
        if ($this->config->get('plugins.prism-highlight.all-pre-blocks')) {
            $inline .= "$('pre:not([class*=\'language-\'])').addClass('language-txt');\n";
        }

        // Line Numbers management
        if ($this->config->get('plugins.prism-highlight.plugins.line-numbers')) {
            $inline .= "$('pre').addClass('line-numbers');\n";
        }

        // Command Line management
        if ($this->config->get('plugins.prism-highlight.plugins.command-line')) {
            $inline .= "$('pre').addClass('command-line');\n";
        }

        if ($inline) {
            $this->grav['assets']->addInlineJs($inline, null, 'bottom');
        }

    }

    public static function themeOptions()
    {
        $options = [];

        $theme_files = glob(__dir__ . '/css/themes/*.css');
        foreach ($theme_files as $theme_file) {
            $theme = basename($theme_file);
            $options[$theme] = Inflector::titleize($theme);
        }

        return $options;
    }
}
