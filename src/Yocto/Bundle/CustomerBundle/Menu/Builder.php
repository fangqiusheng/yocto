<?php

namespace Yocto\Bundle\CustomerBundle\Menu;

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
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * Builds icon Pane
     * @param   FactoryInterface  $factory
     * @param   Array             $option
     * @return  $menu
     */
    public function iconPane(FactoryInterface $factory, array $options)
    {
        // Basic set up
        $this->factory  = $factory;

        // Create menu
        $menu = $this
            ->factory
            ->createItem('IconPane', array(
                'attributes' => array('class' => 'y-iconPane')
            ));

        // Add "0" item to the menu
        $menu->addChild('zero', array());        

        return $menu;        
    }
}
