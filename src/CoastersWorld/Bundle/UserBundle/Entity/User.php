<?php

namespace CoastersWorld\Bundle\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * CoastersWorld\Bundle\UserBundle\Entity\User
 */
class User implements UserInterface, \Serializable
{

    const ROLE_DEFAULT = 'ROLE_USER';

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $salt
     */
    private $salt;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var \DateTime $createdAt
     */
    private $createdAt;

    /**
     * @var boolean $isActive
     */
    private $isActive;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $group;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add group
     *
     * @param CoastersWorld\Bundle\UserBundle\Entity\Group $group
     * @return User
     */
    public function addGroup(\CoastersWorld\Bundle\UserBundle\Entity\Group $group)
    {
        $this->group[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param CoastersWorld\Bundle\UserBundle\Entity\Group $group
     */
    public function removeGroup(\CoastersWorld\Bundle\UserBundle\Entity\Group $group)
    {
        $this->group->removeElement($group);
    }

    /**
     * Get group
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        foreach ($this->getGroup() as $group) {
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

    /**
     * Add comments
     *
     * @param \CoastersWorld\BundleNewsBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\CoastersWorld\Bundle\NewsBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \CoastersWorld\Bundle\NewsBundle\Entity\Comment $comments
     */
    public function removeComment(\CoastersWorld\Bundle\NewsBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ratings;


    /**
     * Add ratings
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings
     * @return User
     */
    public function addRating(\CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;
    
        return $this;
    }

    /**
     * Remove ratings
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings
     */
    public function removeRating(\CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRatings()
    {
        return $this->ratings;
    }
}