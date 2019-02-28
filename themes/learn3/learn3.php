<?php
namespace Grav\Theme;

use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;

class Learn3 extends Theme
{
    public static function getSubscribedEvents() {
        return [
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onTwigPageVariables' => ['onTwigPageVariables', 0],
            'onTNTSearchQuery' => ['onTNTSearchQuery', 1000],
        ];
    }

    public function onTwigInitialized() {
        $sc = $this->grav['shortcode'];
        $sc->getHandlers()->addAlias('version', 'lang');
    }


    public function onTwigPageVariables()
    {
        $this->grav['twig']->twig_vars['grav_version'] = GRAV_VERSION;
    }

    public function onTNTSearchQuery(Event $e)
    {
        $query = $this->grav['uri']->param('q');

        if ($query) {
            $page = $e['page'];
            $query = $e['query'];
            $options = $e['options'];
            $fields = $e['fields'];

            $fields->results[] = $page->route();
            $e->stopPropagation();
        }
    }

}
