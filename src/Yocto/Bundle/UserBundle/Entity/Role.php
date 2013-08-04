<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Yocto\Bundle\UserBundle\Entity\Group;

/**
 * @ORM\Table(name="acl_roles")
 * @ORM\Entity()
 */
class Role implements RoleInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="roles")
     */
    private $gropus;

    public function __construct()
    {
        $this->gropus = new ArrayCollection();
    }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->role;
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
     * @return Role
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
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Add users
     *
     * @param \Yocto\Bundle\UserBundle\Entity\User $users
     * @return Role
     */
    public function addUser(\Yocto\Bundle\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Yocto\Bundle\UserBundle\Entity\User $users
     */
    public function removeUser(\Yocto\Bundle\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add gropus
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Group $gropus
     * @return Role
     */
    public function addGropu(\Yocto\Bundle\UserBundle\Entity\Group $gropus)
    {
        $this->gropus[] = $gropus;

        return $this;
    }

    /**
     * Remove gropus
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Group $gropus
     */
    public function removeGropu(\Yocto\Bundle\UserBundle\Entity\Group $gropus)
    {
        $this->gropus->removeElement($gropus);
    }

    /**
     * Get gropus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGropus()
    {
        return $this->gropus;
    }
}
