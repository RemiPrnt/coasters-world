<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 */
class Type
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
    private $refCoasters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->refCoasters = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Type
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
     * Add refCoasters
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster $refCoasters
     * @return Type
     */
    public function addRefCoaster(\CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster $refCoasters)
    {
        $this->refCoasters[] = $refCoasters;
    
        return $this;
    }

    /**
     * Remove refCoasters
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster $refCoasters
     */
    public function removeRefCoaster(\CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster $refCoasters)
    {
        $this->refCoasters->removeElement($refCoasters);
    }

    /**
     * Get refCoasters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRefCoasters()
    {
        return $this->refCoasters;
    }
}