<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Park
 *
 * @ORM\Table(name="ref_park")
 * @ORM\Entity
 */
class Park
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
     * @ORM\Column(name="name", type="string", length=255, unique=false, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, unique=false, nullable=true)
     */
    private $website;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Coaster", mappedBy="park")
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
     * Set website
     *
     * @param string $website
     * @return Park
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set country
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Country $country
     * @return Park
     */
    public function setCountry(\CoastersWorld\Bundle\SiteBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add coasters
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters
     * @return Park
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
}
