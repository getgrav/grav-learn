<?php
namespace Grav\Theme;

use Grav\Common\Theme;

class Learn3 extends Theme
{
    public static function getSubscribedEvents() {
        return [
            'onTwigPageVariables' => ['onTwigPageVariables', 0],
        ];
    }


    public function onTwigPageVariables()
    {
        $this->grav['twig']->twig_vars['grav_version'] = GRAV_VERSION;
    }

}
