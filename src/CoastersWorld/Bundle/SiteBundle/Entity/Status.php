<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 */
class Status
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
     * @return Status
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
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters
     * @return Status
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
     * @var integer
     */
    private $idTechnical;


    /**
     * Set idTechnical
     *
     * @param integer $idTechnical
     * @return Status
     */
    public function setIdTechnical($idTechnical)
    {
        $this->idTechnical = $idTechnical;

        return $this;
    }

    /**
     * Get idTechnical
     *
     * @return integer
     */
    public function getIdTechnical()
    {
        return $this->idTechnical;
    }
}