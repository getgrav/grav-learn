<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Grav;
use \Grav\Common\Page\Page;

class PrismHighlightPlugin extends Plugin
{
  /**
   * @return array
   */
  public static function getSubscribedEvents()
  {
    return [
        'onPageInitialized' => ['onPageInitialized', 0]
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

    $defaults = (array) $this->config->get('plugins.prism-highlight');

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
   * if enabled on this page, load the JS + CSS theme.
   */
  public function onTwigSiteVariables()
  {
    $theme = $this->config->get('plugins.prism-highlight.theme') ?: 'prism-default.css';
    $this->grav['assets']->addCss('plugin://prism-highlight/css/prism.css');
    $this->grav['assets']->addCss('plugin://prism-highlight/css/'.$theme);
    $this->grav['assets']->addJs('plugin://prism-highlight/js/prism.js', null, true, null, 'bottom');

    // Line numbers management
    if ($this->config->get('plugins.prism-highlight.linenumbers')) {
      $init = "$('pre').addClass('line-numbers');";
      $this->grav['assets']->addInlineJs($init, null, 'bottom');
    }
  }
}
