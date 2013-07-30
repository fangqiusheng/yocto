<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Yocto\Bundle\UsrBundle\Entity\Organisation
 *
 * @ORM\Table(name="acl_organisations")
 * @ORM\Entity()
 */
class Organisation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="UserOrganisationGroup", mappedBy="organisation")
     */
    private $userOrganisationGroup;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Organisation
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userOrganisationGroup = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add userOrganisationGroup
     *
     * @param \Yocto\Bundle\UserBundle\Entity\UserOrganisationGroup $userOrganisationGroup
     * @return Organisation
     */
    public function addUserOrganisationGroup(\Yocto\Bundle\UserBundle\Entity\UserOrganisationGroup $userOrganisationGroup)
    {
        $this->userOrganisationGroup[] = $userOrganisationGroup;
    
        return $this;
    }

    /**
     * Remove userOrganisationGroup
     *
     * @param \Yocto\Bundle\UserBundle\Entity\UserOrganisationGroup $userOrganisationGroup
     */
    public function removeUserOrganisationGroup(\Yocto\Bundle\UserBundle\Entity\UserOrganisationGroup $userOrganisationGroup)
    {
        $this->userOrganisationGroup->removeElement($userOrganisationGroup);
    }

    /**
     * Get userOrganisationGroup
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserOrganisationGroup()
    {
        return $this->userOrganisationGroup;
    }
}