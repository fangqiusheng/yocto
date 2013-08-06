<?php

namespace Yocto\Bundle\LayoutBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class BundleEvent extends Event
{
    const EVENT = "yocto_layout.find_bundles";

    private $bundles;

    public function addBundle($bundle)
    { 
         $this->bundles[] = $bundle;
    }

    public function getBundles()
    {
         return $this->bundles;
    }
}
