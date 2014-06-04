<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface, \Serializable
{
    const ROLE_DEFAULT = 'ROLE_USER';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=32, unique=true, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=32, unique=false, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, unique=false, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=32, unique=false, nullable=true)
     */
    private $activationKey;

    /**
     * @var string
     *
     * @ORM\Column(name="change_password_key", type="string", length=32, unique=false, nullable=true)
     */
    private $changePasswordKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="change_password_date", type="datetime", unique=false, nullable=true)
     */
    private $changePasswordDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", unique=false, nullable=false)
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verified", type="boolean", nullable=false)
     */
    private $verified;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    private $locked;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Coaster", mappedBy="users")
     */
    private $coasters;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="users")
     */
    private $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coasters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enabled = true;
        $this->verified = false;
        $this->locked = false;
        $this->salt = md5(uniqid(null, true));
        $this->activationKey = md5(uniqid(null, true));
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
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
     * @param  string $username
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
     * Set email
     *
     * @param  string $email
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
     * Set salt
     *
     * @param  string $salt
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
     * @param  string $password
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
     * Set activationKey
     *
     * @param  string $activationKey
     * @return User
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;

        return $this;
    }

    /**
     * Get activationKey
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * Set changePasswordKey
     *
     * @param  string $changePasswordKey
     * @return User
     */
    public function setChangePasswordKey($changePasswordKey)
    {
        $this->changePasswordKey = $changePasswordKey;

        return $this;
    }

    /**
     * Get changePasswordKey
     *
     * @return string
     */
    public function getChangePasswordKey()
    {
        return $this->changePasswordKey;
    }

    /**
     * Set changePasswordDate
     *
     * @param  \DateTime $changePasswordDate
     * @return User
     */
    public function setChangePasswordDate($changePasswordDate)
    {
        $this->changePasswordDate = $changePasswordDate;

        return $this;
    }

    /**
     * Get changePasswordDate
     *
     * @return \DateTime
     */
    public function getChangePasswordDate()
    {
        return $this->changePasswordDate;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set enabled
     *
     * @param  boolean $enabled
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set verified
     *
     * @param  boolean $verified
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set locked
     *
     * @param  boolean $locked
     * @return User
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Add coasters
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters
     * @return User
     */
    public function addCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters)
    {
        $this->coasters[] = $coasters;

        return $this;
    }

    /**
     * Remove coasters
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters
     */
    public function removeCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters)
    {
        $this->coasters->removeElement($coasters);
    }

    /**
     * Get coasters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoasters()
    {
        return $this->coasters;
    }

    /**
     * Add groups
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\CoastersWorld\Bundle\SiteBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Group $groups
     */
    public function removeGroup(\CoastersWorld\Bundle\SiteBundle\Entity\Group $groups)
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
        foreach ($this->getGroups() as $group) {
            $roles[] = $group->getRole();
        }

        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;

        return array_unique($roles);
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
}
