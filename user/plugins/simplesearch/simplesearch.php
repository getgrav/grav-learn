<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Registry;
use Grav\Common\Uri;
use Grav\Common\Page\Page;
use Grav\Common\Taxonomy;

class SimplesearchPlugin extends Plugin
{
    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @var array
     */
    protected $query;

    /**
     * @var string
     */
    protected $query_id;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * Enable search only if url matches to the configuration.
     */
    public function onAfterInitPlugins()
    {
        /** @var Uri $uri */
        $uri = Registry::get('Uri');
        $query = $uri->param('query');
        $route = $this->config->get('plugins.simplesearch.route');

        if ($route && $route == $uri->path() && $query) {
            $this->query = explode(',', $query);

            // disable debugger if JSON format
            if ($uri->extension() == 'json') {
                $this->config->set('system.debugger.enabled', false);
            }

            $this->active = true;
        }
    }

    /**
     * Build search results.
     */
    public function onAfterGetPages()
    {
        if (!$this->active) {
            return;
        }

        /** @var Taxonomy $taxonomy_map */
        $taxonomy_map = Registry::get('Taxonomy');

        $filters = (array) $this->config->get('plugins.simplesearch.filters');

        $this->collection = new Collection();
        foreach ($filters as $taxonomy => $items) {
            if (isset($items)) {
                $this->collection->append($taxonomy_map->findTaxonomy([$taxonomy => $items])->toArray());
            }
        }

        foreach ($this->collection as $page) {
            foreach ($this->query as $query) {
                $query = trim($query);

                if (stripos($page->content(), $query) === false && stripos($page->title(), $query) === false) {
                    $this->collection->remove($page);
                }
            }
        }
    }

    /**
     * Create search result page.
     */
    public function onAfterGetPage()
    {
        if (!$this->active) {
            return;
        }

        $page = new Page;
        $page->init(new \SplFileInfo(__DIR__ . '/pages/simplesearch.md'));

        // override the template is set in the config
        $template_override = $this->config->get('plugins.simplesearch.template');
        if ($template_override) {
            $page->template($template_override);
        }

        Registry::get('Grav')->page = $page;
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onAfterTwigTemplatesPaths()
    {
        if (!$this->active) {
            return;
        }

        Registry::get('Twig')->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Set needed variables to display the search results.
     */
    public function onAfterSiteTwigVars()
    {
        if (!$this->active) {
            return;
        }

        $twig = Registry::get('Twig');
        $twig->twig_vars['query'] = implode(', ', $this->query);

        $twig->twig_vars['search_results'] = $this->collection;

        if ($this->config->get('plugins.simplesearch.built_in_css')) {
            $twig->twig_vars['stylesheets'][] = 'user/plugins/simplesearch/simplesearch.css';
        }
    }
}
