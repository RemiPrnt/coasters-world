<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="ref_type")
 * @ORM\Entity
 */
class Type
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ObjectCoaster", mappedBy="types")
     */
    private $objectCoasters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objectCoasters = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param  string $name
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
     * Add objectCoasters
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster $objectCoasters
     * @return Type
     */
    public function addObjectCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster $objectCoasters)
    {
        $this->objectCoasters[] = $objectCoasters;

        return $this;
    }

    /**
     * Remove objectCoasters
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster $objectCoasters
     */
    public function removeObjectCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster $objectCoasters)
    {
        $this->objectCoasters->removeElement($objectCoasters);
    }

    /**
     * Get objectCoasters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjectCoasters()
    {
        return $this->objectCoasters;
    }
}
