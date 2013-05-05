<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\DatabaseBundle\Entity\Rating
 */
class Rating
{
    /**
     * @var integer
     */
    private $value;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster
     */
    private $coaster;


    /**
     * Set value
     *
     * @param integer $value
     * @return Rating
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
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
     * Set coaster
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster $coaster
     * @return Rating
     */
    public function setCoaster(\CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster $coaster = null)
    {
        $this->coaster = $coaster;

        return $this;
    }

    /**
     * Get coaster
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster
     */
    public function getCoaster()
    {
        return $this->coaster;
    }
    /**
     * @var \CoastersWorld\Bundle\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \CoastersWorld\Bundle\UserBundle\Entity\User $user
     * @return Rating
     */
    public function setUser(\CoastersWorld\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \CoastersWorld\Bundle\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}