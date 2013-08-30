<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\SiteBundle\Entity\Rating
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
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\Coaster
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
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster
     * @return Rating
     */
    public function setCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster = null)
    {
        $this->coaster = $coaster;

        return $this;
    }

    /**
     * Get coaster
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Coaster
     */
    public function getCoaster()
    {
        return $this->coaster;
    }
    /**
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\User $user
     * @return Rating
     */
    public function setUser(\CoastersWorld\Bundle\SiteBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}