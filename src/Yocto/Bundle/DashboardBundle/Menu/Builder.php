<?php

namespace Yocto\Bundle\DashboardBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerAware;
use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;

class Builder extends ContainerAware
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    private $security;

    /**
     * Builds option menu for Dashboard
     * @param   FactoryInterface  $factory
     * @param   Array             $option
     * @return  $menu
     */
    public function optionMenu(FactoryInterface $factory, array $options)
    {
        // Basic set up
        $this->factory  = $factory;
        $this->security = $this->container->get('security.context');

        // Create menu
        $menu = $this
            ->factory
            ->createItem('root');

        if ($this->security->isGranted('ROLE_USER')) {

            // Add item to the menu
            $menu->addChild('Welcome', array(
                'route' => 'default_dashboard',
                'uri'   => '#dashboard'
            ));
        }

        return $menu;
    }
}
