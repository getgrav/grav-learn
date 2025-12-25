<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * PreTwig Plugin
 *
 * Pre-processes alternative Twig syntax (<< >> and <% %>) before standard
 * Twig/Markdown processing. This allows pages to use dynamic Twig variables
 * while still displaying Twig code examples in code blocks.
 *
 * Syntax:
 *   << expression >>     - Output (equivalent to {{ expression }})
 *   <% statement %>      - Execution (equivalent to {% statement %})
 *
 * Example:
 *   <% set version = '1.7.49' %>
 *   Current version: << version >>
 *
 *   ```twig
 *   {{ page.title }}  <- This won't be processed, displayed as-is
 *   ```
 */
class PretwigPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't process in admin
        if ($this->isAdmin()) {
            return;
        }

        $this->enable([
            'onPageContentRaw' => ['onPageContentRaw', 100000] // Very high priority - run first
        ]);
    }

    /**
     * Process raw page content before any other processing
     */
    public function onPageContentRaw(Event $event): void
    {
        $page = $event['page'];
        $content = $page->getRawContent();

        // Quick check - skip if no pretwig syntax present
        if (strpos($content, '<<') === false && strpos($content, '<%') === false) {
            return;
        }

        try {
            $processed = $this->processPretwig($content);
            $page->setRawContent($processed);
        } catch (\Exception $e) {
            $this->grav['log']->error('PreTwig: Error processing page ' . $page->route() . ': ' . $e->getMessage());
        }
    }

    /**
     * Process pretwig syntax in content
     */
    protected function processPretwig(string $content): string
    {
        // Step 1: Protect existing Twig syntax by replacing with placeholders
        $protected = [];
        $counter = 0;

        // Protect {{ ... }} (echo syntax)
        $content = preg_replace_callback('/\{\{.*?\}\}/s', function ($match) use (&$protected, &$counter) {
            $key = '___PRETWIG_PROTECTED_' . $counter++ . '___';
            $protected[$key] = $match[0];
            return $key;
        }, $content);

        // Protect {% ... %} (tag syntax)
        $content = preg_replace_callback('/\{%.*?%\}/s', function ($match) use (&$protected, &$counter) {
            $key = '___PRETWIG_PROTECTED_' . $counter++ . '___';
            $protected[$key] = $match[0];
            return $key;
        }, $content);

        // Protect {# ... #} (comment syntax)
        $content = preg_replace_callback('/\{#.*?#\}/s', function ($match) use (&$protected, &$counter) {
            $key = '___PRETWIG_PROTECTED_' . $counter++ . '___';
            $protected[$key] = $match[0];
            return $key;
        }, $content);

        // Step 2: Convert pretwig syntax to Twig syntax
        // << expression >> -> {{ expression }}
        $content = preg_replace('/<<\s*(.*?)\s*>>/s', '{{ $1 }}', $content);
        // <% statement %> -> {% statement %}
        $content = preg_replace('/<%\s*(.*?)\s*%>/s', '{% $1 %}', $content);

        // Step 3: Process through Twig
        $twig = $this->grav['twig'];
        $twigEnv = $twig->twig();

        // Build context with all standard Grav variables
        $context = [
            'grav' => $this->grav,
            'config' => $this->grav['config'],
            'site' => $this->grav['config']->get('site'),
            'pages' => $this->grav['pages'],
            'page' => $this->grav['page'],
            'header' => $this->grav['page'] ? $this->grav['page']->header() : null,
            'media' => $this->grav['page'] ? $this->grav['page']->media() : null,
            'uri' => $this->grav['uri'],
            'browser' => $this->grav['browser'] ?? null,
            'assets' => $this->grav['assets'],
            'taxonomy' => $this->grav['taxonomy'],
            'theme' => $this->grav['theme'] ?? null,
        ];

        // Merge any existing Twig variables
        $context = array_merge($twig->twig_vars, $context);

        // Create and render the template
        $template = $twigEnv->createTemplate($content);
        $content = $template->render($context);

        // Step 4: Restore protected placeholders
        foreach ($protected as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }
}
