<?php

namespace Yocto\Bundle\LayoutBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerAware;
use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;

use Yocto\Bundle\LayoutBundle\Event\BundleEvent;

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

    private $bundle;

    public function setBundle($path, $role)
    {
        $this->bundle = array('name' => $path, 'role' => $role);
    }

    public function addBundle(BundleEvent $event)
    {
         $event->addBundle($this->bundle);
    }

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $bundles = $this->container->get('event_dispatcher')->dispatch(BundleEvent::EVENT, new BundleEvent())->getBundles();

        // Basic setup
        $this->factory  = $factory;
        $this->security = $this->container->get('security.context');

        // Create menu
        $menu = $this->factory->createItem('root');

        // Add Menu items that are available for user
        foreach($bundles as $bundle) {
            if ($this->security->isGranted($bundle['role'])) {

                // Only add the menu if user has granted at least minimum access
                $menu->addChild($bundle['name'], array(
                    'route' => 'default_dashboard',
                    'uri'   => '#dashboard'
                ));
            }
        }

        return $menu;
    }
}
