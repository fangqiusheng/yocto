<?php

namespace Yocto\Bundle\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/customers")
 */
class DefaultController extends Controller
{
    /**
     * @Route("", name="default_customers")
     * @Secure(roles="ROLE_CUSTOMERS")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        return array();
    }
}
