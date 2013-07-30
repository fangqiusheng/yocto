<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

use \Yocto\Bundle\UserBundle\Entity\Role;

/**
 * Yocto\Bundle\UsrBundle\Entity\User
 *
 * @ORM\Table(name="acl_users")
 * @ORM\Entity(repositoryClass="Yocto\Bundle\UserBundle\Entity\UserReository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="is_expired", type="boolean")
     */
    private $isExpired;

    /**
     * @ORM\Column(name="expires_at", type="datetime")
     */
    private $expiresAt;

    /**
     * @ORM\Column(name="is_credentials_expired", type="boolean")
     */
    private $credentialsExpired;

    /**
     * @ORM\Column(name="credentials_expire_at", type="datetime")
     */
    private $credentialsExpireAt;

    /**
     * @ORM\OneToMany(targetEntity="UserOrganisationGroup", mappedBy="user")
     */
    private $userOrganisationGroup;

    public function __construct()
    {
        $this->salt                 = md5(uniqid(null, true));
        $this->roles                = new ArrayCollection();
        $this->isActive             = true;
        $this->isExpired            = false;
        $this->credentialsExpired   = false;
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
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
     * Set isExpired
     *
     * @param boolean $isExpired
     * @return User
     */
    public function setIsExpired($isExpired)
    {
        $this->isExpired = $isExpired;
    
        return $this;
    }

    /**
     * Get isExpired
     *
     * @return boolean 
     */
    public function getIsExpired()
    {
        return $this->isExpired;
    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return User
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
    
        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set credentialsExpired
     *
     * @param boolean $credentialsExpired
     * @return User
     */
    public function setCredentialsExpired($credentialsExpired)
    {
        $this->credentialsExpired = $credentialsExpired;
    
        return $this;
    }

    /**
     * Get credentialsExpired
     *
     * @return boolean
     */
    public function getCredentialsExpired()
    {
        return $this->credentialsExpired;
    }

    /**
     * Set credentialsExpireAt
     *
     * @param \DateTime $credentialsExpireAt
     * @return User
     */
    public function setCredentialsExpireAt($credentialsExpireAt)
    {
        $this->credentialsExpireAt = $credentialsExpireAt;

        return $this;
    }

    /**
     * Get credentialsExpireAt
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    /**
     Methods Inherited from UserInterface
     *
     * @inheritDoc
     */
    public function isAccountNonExpired()
    {
        if (true === $this->isExpired) {
            return false;
        }

        if (null !== $this->expiresAt && $this->expiresAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function isCredentialsNonExpired()
    {
        if (true === $this->credentialsExpired) {
            return false;
        }

        if (null !== $this->credentialsExpireAt && $this->credentialsExpireAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }

    /**
     * Add roles
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Yocto\Bundle\UserBundle\Entity\Role $roles
     */
    public function removeRole(Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Add userOrganisationGroup
     *
     * @param \Yocto\Bundle\UserBundle\Entity\UserOrganisationGroup $userOrganisationGroup
     * @return User
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
