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
     * @var Array bundle
     */
    private $bundle;

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    public function setBundle(array $bundle)
    {
        $this->bundle = $bundle;
    }

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

        $this->bundle = $this
            ->container
            ->get('yocto_customer.icon_builder')
            ->bundle;

        $this->security = $this
            ->container
            ->get('security.context');

        // Create menu
        $menu = $this
            ->factory
            ->createItem('IconPane', array(
                'attributes' => array('class' => 'y-iconPane'),
            ))
            ->setLabelAttributes(
                array('class' => 'fa fa-book fa-lg')
            );

        // Add customer option
        // We only want add customer if the user satisfies the minimum role requirements
        // which can also be unspecified in case if no special requirements are needed
        // in order to access the functionality

        if (!isset($this->bundle['roles']) || $this->security->isGranted($this->bundle['roles']['create'])) {
            $menu->addChild('Add Customer', array(
                'route' => 'default_dashboard',
                'attributes' => array(
                    'class' => 'y-btn y-btn-24'
                    ),
            ));
        }

        return $menu;        
    }
}
