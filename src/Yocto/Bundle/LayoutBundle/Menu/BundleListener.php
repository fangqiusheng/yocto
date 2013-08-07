<?php

namespace Yocto\Bundle\LayoutBundle\Menu;

use Yocto\Bundle\LayoutBundle\Event\BundleEvent;

class BundleListener
{ 
    private $bundle;

    public function __construct($bundle)
    { 
         $this->bundle= $bundle;
    }

    public function addBundle(BundleEvent $event)
    {
         $event->addBundle($this->bundle);
    }
}
