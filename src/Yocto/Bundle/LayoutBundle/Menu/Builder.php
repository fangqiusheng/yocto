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

    /**
     * @var Array bundle
     */
    private $bundle;

    public function setBundle(array $bundle)
    {
        $this->bundle = $bundle;
    }

    public function addBundle(BundleEvent $event)
    {
         $event->addBundle($this->bundle);
    }

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        // Get bundles that have registered the menu
        $bundles = $this
            ->container
            ->get('event_dispatcher')
            ->dispatch(BundleEvent::EVENT, new BundleEvent())
            ->getBundles();

        // Basic set up
        $this->factory  = $factory;
        $this->security = $this->container->get('security.context');

        // Create menu
        $menu = $this
            ->factory
            ->createItem('root');

        // Sort the list
        $this->sortBundles($bundles);

        // Add Menu items that are available for user
        foreach($bundles as $bundle) {
            // We only want add bundles if the user satisfies the minimum role requirements
            // which can also be unspecified in case if no special requirements are needed
            // in order to access the bundle (i.e. dashboard?)
            if (!isset($bundle['role']) || $this->security->isGranted($bundle['role'])) {

                // Add item to the menu
                $menu->addChild($bundle['name'], array(
                    'route' => 'default_dashboard',
                    'uri'   => '#dashboard'
                ));
            }

        }

        return $menu;
    }

    /**
     * This function allows as to order our menu accordingly to priority list
     * @param   Array $bundles     Array of bundles to sort
     * @return  Array $ordered     Ordered array of bundles by their priority
     */
    private function sortBundles(array $bundles)
    {
        // First let's create some space for sorting items
        // havePrioritySet will store elements that had priority set
        $havePrioritySet = array();

        // Now some items may not have any priority option set at all
        // We will add them to the end of the list
        $noPrioritySet = array();

        // Our new ordered list of bundles
        $ordered = array();

        foreach ($bundles as $bundle) {
            if (isset($bundle['priority'])) {
                array_push(
                    $havePrioritySet,
                    array('priority' => $bundle['priority'], 'bundle' => $bundle)
                );
            } else {
                array_push($noPrioritySet, $bundle);
            }
        }

        // Sort both prioritised and non-prioritised collections
        asort($havePrioritySet);
        asort($noPrioritySet);

        // Loop through our collections and add them to the list
        foreach ($havePrioritySet as $prioritised) {
            array_push($ordered, $prioritised['bundle']);
        }

        foreach ($noPrioritySet as $nonPrioritised) {
            array_push($ordered, $nonPrioritised);
        }

        return $ordered;
    }
}
