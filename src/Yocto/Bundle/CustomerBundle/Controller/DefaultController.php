<?php

namespace Yocto\Bundle\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/customers")
 */
class DefaultController extends Controller
{
    /**
     * @var Access roles for this bundle
     */
    private $accessRoles;

    /**
     * @Route("", name="default_customers")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $bundleSettings = $this->container->getParameter('yocto_customer.bundle');

        if (isset($bundleSettings['roles'])) {
            $this->accessRoles = $bundleSettings['roles'];
        }

#        var_dump($this->accessRoles);die;

        return array();
    }
}
