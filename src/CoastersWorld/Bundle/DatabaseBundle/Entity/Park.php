<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Park
 */
class Park
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $coasters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coasters = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Park
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add coasters
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster $coasters
     * @return Park
     */
    public function addCoaster(\CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster $coasters)
    {
        $this->coasters[] = $coasters;
    
        return $this;
    }

    /**
     * Remove coasters
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster $coasters
     */
    public function removeCoaster(\CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster $coasters)
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
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\Country
     */
    private $country;


    /**
     * Set country
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Country $country
     * @return Park
     */
    public function setCountry(\CoastersWorld\Bundle\DatabaseBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}