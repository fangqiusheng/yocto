<?php

namespace Yocto\Bundle\UserBundle\Menu;

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
            ->get('yocto_user.icon_builder')
            ->bundle;

        $this->security = $this
            ->container
            ->get('security.context');

        // Create menu
        $menu = $this
            ->factory
            ->createItem('IconPane', array(
                'attributes' => array('class' => 'y-iconPane'),
            ));

        // Add user option
        // We only want add user if the user satisfies the minimum role requirements
        // which can also be unspecified in case if no special requirements are needed
        // in order to access the functionality

        if (!isset($this->bundle['roles']) || $this->security->isGranted($this->bundle['roles']['create'])) {
            $menu->addChild('Add User', array(
                'route' => 'default_dashboard',
                'attributes' => array(
                    'class' => 'y-btn y-btn-24'
                ),
            ))->setLabelAttributes(array('class' => 'fa fa-plus fa-lg'));
        }

        return $menu;        
    }
}
