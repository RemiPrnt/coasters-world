<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Launch
 */
class Launch
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
     * @return Launch
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
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster $refCoasters
     * @return Launch
     */
    public function addRefCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster $refCoasters)
    {
        $this->refCoasters[] = $refCoasters;

        return $this;
    }

    /**
     * Remove refCoasters
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster $refCoasters
     */
    public function removeRefCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster $refCoasters)
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
