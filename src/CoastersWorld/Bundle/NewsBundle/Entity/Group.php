<?php

namespace CoastersWorld\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\NewsBundle\Entity\Group
 */
class Group
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $role
     */
    private $role;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set role
     *
     * @param string $role
     * @return Group
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
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
     * Add user
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\User $user
     * @return Group
     */
    public function addUser(\CoastersWorld\Bundle\NewsBundle\Entity\User $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\User $user
     */
    public function removeUser(\CoastersWorld\Bundle\NewsBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}
