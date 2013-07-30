<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Yocto\Bundle\UsrBundle\Entity\Group
 *
 * @ORM\Table(name="acl_groups")
 * @ORM\Entity(repositoryClass="Yocto\Bundle\UserBundle\Entity\GroupReository")
 */
class Group
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="groups")
     * @ORM\JoinTable(name="acl_group_roles")
     *
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="UserOrganisationGroup", mappedBy="group")
     */
    private $userOrganisationGroup;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }
    
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
     * @return Group
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
     * Set description
     *
     * @param string $description
     * @return Group
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add roles
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Role $roles
     * @return Group
     */
    public function addRole(\Yocto\Bundle\UserBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Role $roles
     */
    public function removeRole(\Yocto\Bundle\UserBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add userOrganisationGroup
     *
     * @param \Yocto\Bundle\UserBundle\Entity\UserOrganisationGroup $userOrganisationGroup
     * @return Group
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
