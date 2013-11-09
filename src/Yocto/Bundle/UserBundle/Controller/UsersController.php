<?php

namespace Yocto\Bundle\UserBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/users")
 */
class UsersController extends Controller
{
    /**
     * @Route("", name="users_lists_users")
     * @Template()
     */
    public function listAction()
    {
        return array();
    }
}
