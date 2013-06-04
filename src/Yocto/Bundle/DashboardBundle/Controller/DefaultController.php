<?php

namespace Yocto\Bundle\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/dashboard")
 */
class DefaultController extends Controller
{
    /**
     * @Route("", name="default_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        return array();
    }
}
