<?php

namespace Yocto\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

use Yocto\Bundle\UserBundle\Entity\Group AS Group;

/**
 * Yocto\Bundle\UsrBundle\Entity\User
 *
 * @ORM\Table(name="acl_users")
 * @ORM\Entity(repositoryClass="Yocto\Bundle\UserBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
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
     * @ORM\Column(type="string", length=64, unique=true)
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
     * @ORM\Column(name="is_locked", type="boolean")
     */
    private $isLocked;

    /**
     * @ORM\Column(name="is_credentials_expired", type="boolean")
     */
    private $isCredentialsExpired;

    /**
     * @ORM\Column(name="expires_at", type="datetime")
     */
    private $expiresAt;

    /**
     * @ORM\Column(name="credentials_expire_at", type="datetime")
     */
    private $credentialsExpireAt;

    /**
     * @ORM\Column(name="token", type="string", length=32)
     */
    private $token;

    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="users")
     */
    private $groups;

    /**
     *  User Roles
     * @var roles Array
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->roles  = array();
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
     * Set isLocked
     *
     * @param boolean $isLocked
     * @return User
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked
     *
     * @return boolean
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set isCredentialsExpired
     *
     * @param boolean $isCredentialsExpired
     * @return User
     */
    public function setIsCredentialsExpired($isCredentialsExpired)
    {
        $this->isCredentialsExpired = $isCredentialsExpired;

        return $this;
    }

    /**
     * Get isCredentialsExpired
     *
     * @return boolean
     */
    public function getIsCredentialsExpired()
    {
        return $this->isCredentialsExpired;
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
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Add groups
     *
     * @param Group $groups
     * @return User
     */
    public function addGroup(Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param Group $groups
     */
    public function removeGroup(Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        // we need to make sure to have at least one role
        $this->roles[] = "ROLE_USER";

        // Get User groups
        foreach ($this->getGroups()->toArray() as $group) {
            $this->addChildrenRoles($group);
        }

        return array_unique($this->roles);
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
     * @inheritDoc
     */
    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * @inheritDoc
     */
    public function isAccountNonLocked()
    {
        return !$this->isLocked;
    }

    /**
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
    public function isCredentialsNonExpired()
    {
        if (true === $this->isCredentialsExpired) {
            return false;
        }

        if (null !== $this->isCredentialsExpired && $this->credentialsExpireAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    /**
     * Checks if group has a child and adds descendent children roles
     * @param   Group   $group  ACL Group
     */
    private function addChildrenRoles(Group $group)
    {
        foreach ($roles = $this->getGroupRoles($group) as $role) {
            if ($role) {
                $this->roles[] = $role;
            }
        }


        // Check if there are any descendent children
        if (count($group->getChildren())) {
            foreach ($group->getChildren() as $child) {
                $this->addChildrenRoles($child);
            }
            return true;
        }

        return false;
    }

    /**
     * Gets Group roles
     * @param   Group   $group  ACL Group to get the roles for
     * @return  Array   $roles  Array of user roles
     */
    private function getGroupRoles(Group $group)
    {
        $roles = array();
        foreach ($group->getRoles() as $role) {
            array_push($roles, $role->getRole());
        }

        return $roles;
    }
}
