<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 */
class Country
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
    private $parks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
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
     * Add parks
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Park $parks
     * @return Country
     */
    public function addPark(\CoastersWorld\Bundle\SiteBundle\Entity\Park $parks)
    {
        $this->parks[] = $parks;

        return $this;
    }

    /**
     * Remove parks
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Park $parks
     */
    public function removePark(\CoastersWorld\Bundle\SiteBundle\Entity\Park $parks)
    {
        $this->parks->removeElement($parks);
    }

    /**
     * Get parks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParks()
    {
        return $this->parks;
    }
}