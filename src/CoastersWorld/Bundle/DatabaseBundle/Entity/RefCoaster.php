<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RefCoaster
 */
class RefCoaster
{
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
     * @return RefCoaster
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
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\Manufacturer
     */
    private $manufacturer;


    /**
     * Set manufacturer
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Manufacturer $manufacturer
     * @return RefCoaster
     */
    public function setManufacturer(\CoastersWorld\Bundle\DatabaseBundle\Entity\Manufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;
    
        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\Manufacturer 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
    /**
     * @var integer
     */
    private $speed;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var integer
     */
    private $length;

    /**
     * @var integer
     */
    private $inversionNumber;

    /**
     * @var float
     */
    private $gForce;


    /**
     * Set speed
     *
     * @param integer $speed
     * @return RefCoaster
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    
        return $this;
    }

    /**
     * Get speed
     *
     * @return integer 
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return RefCoaster
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @return RefCoaster
     */
    public function setLength($length)
    {
        $this->length = $length;
    
        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set inversionNumber
     *
     * @param integer $inversionNumber
     * @return RefCoaster
     */
    public function setInversionNumber($inversionNumber)
    {
        $this->inversionNumber = $inversionNumber;
    
        return $this;
    }

    /**
     * Get inversionNumber
     *
     * @return integer 
     */
    public function getInversionNumber()
    {
        return $this->inversionNumber;
    }

    /**
     * Set gForce
     *
     * @param float $gForce
     * @return RefCoaster
     */
    public function setGForce($gForce)
    {
        $this->gForce = $gForce;
    
        return $this;
    }

    /**
     * Get gForce
     *
     * @return float 
     */
    public function getGForce()
    {
        return $this->gForce;
    }
    /**
     * @var \DateTime
     */
    private $duration;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $launchs;


    /**
     * Set duration
     *
     * @param \DateTime $duration
     * @return RefCoaster
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Add launchs
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Launch $launchs
     * @return RefCoaster
     */
    public function addLaunch(\CoastersWorld\Bundle\DatabaseBundle\Entity\Launch $launchs)
    {
        $this->launchs[] = $launchs;
    
        return $this;
    }

    /**
     * Remove launchs
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Launch $launchs
     */
    public function removeLaunch(\CoastersWorld\Bundle\DatabaseBundle\Entity\Launch $launchs)
    {
        $this->launchs->removeElement($launchs);
    }

    /**
     * Get launchs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLaunchs()
    {
        return $this->launchs;
    }
    /**
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\Restraint
     */
    private $restraint;


    /**
     * Set restraint
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Restraint $restraint
     * @return RefCoaster
     */
    public function setRestraint(\CoastersWorld\Bundle\DatabaseBundle\Entity\Restraint $restraint = null)
    {
        $this->restraint = $restraint;
    
        return $this;
    }

    /**
     * Get restraint
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\Restraint 
     */
    public function getRestraint()
    {
        return $this->restraint;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $types;


    /**
     * Add types
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Type $types
     * @return RefCoaster
     */
    public function addType(\CoastersWorld\Bundle\DatabaseBundle\Entity\Type $types)
    {
        $this->types[] = $types;
    
        return $this;
    }

    /**
     * Remove types
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Type $types
     */
    public function removeType(\CoastersWorld\Bundle\DatabaseBundle\Entity\Type $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypes()
    {
        return $this->types;
    }
}