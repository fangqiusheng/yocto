<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Yocto\Bundle\InstallationBundle\Entity\Installation;
use Yocto\Bundle\UserBundle\Entity\Organisation;
use Yocto\Bundle\UserBundle\Entity\User;

/**
 * @ORM\Table(name="acl_organisations")
 * @ORM\Entity()
 */
class Organisation
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="Organisation", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Organisation", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="organisations")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Yocto\Bundle\InstallationBundle\Entity\Installation", mappedBy="organisation")
     */
    private $installations;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Organisation
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add children
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Organisation $children
     * @return Organisation
     */
    public function addChildren(Organisation $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Organisation $children
     */
    public function removeChildren(Organisation $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Organisation $parent
     * @return Organisation
     */
    public function setParent(Organisation $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Yocto\Bundle\UserBundle\Entity\Organisation
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add users
     *
     * @param \Yocto\Bundle\UserBundle\Entity\User $users
     * @return Organisation
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Yocto\Bundle\UserBundle\Entity\User $users
     */
    public function removeUser(User $users)
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
     * Add installations
     *
     * @param \Yocto\Bundle\InstallationBundle\Entity\Installation $installations
     * @return Organisation
     */
    public function addInstallation(Installation $installations)
    {
        $this->installations[] = $installations;

        return $this;
    }

    /**
     * Remove installations
     *
     * @param \Yocto\Bundle\InstallationBundle\Entity\Installation $installations
     */
    public function removeInstallation(Installation $installations)
    {
        $this->installations->removeElement($installations);
    }

    /**
     * Get installations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstallations()
    {
        return $this->installations;
    }
}
