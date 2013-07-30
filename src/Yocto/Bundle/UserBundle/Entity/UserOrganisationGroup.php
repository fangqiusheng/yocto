<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Yocto\Bundle\UsrBundle\Entity\UserOrganisationGroup
 *
 * @ORM\Table(name="acl_user_organisation_group")
 * @ORM\Entity()
 */
class UserOrganisationGroup
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userOrganisationGroup")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="userOrganisationGroup")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     */
    private $group;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Organisation", inversedBy="userOrganisationGroup")
     * @ORM\JoinColumn(name="organisation_id", referencedColumnName="id", nullable=false)
     */
    private $organisation;
}
