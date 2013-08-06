<?php

namespace Yocto\Bundle\LayoutBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerAware;
use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'default_dashboard'));
        $menu->addChild('About Me', array(
            'route' => 'default_dashboard',
            'routeParameters' => array('id' => 42)
        ));
        // ... add more children

        return $menu;
    }
}
