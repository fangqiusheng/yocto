<?php

namespace Yocto\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Yocto\Bundle\UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/hello")
     * @Template()
     */
    public function indexAction($name)
    {
        return array();
    }
}
