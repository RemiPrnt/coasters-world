<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RefCoaster
 *
 * @ORM\Table(name="object_coaster")
 * @ORM\Entity
 */
class ObjectCoaster
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
     * @ORM\Column(name="speed", type="decimal", precision=4, scale=1, unique=false, nullable=true)
     */
    private $speed;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="decimal", precision=4, scale=1, unique=false, nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="decimal", precision=5, scale=1, unique=false, nullable=true)
     */
    private $length;

    /**
     * @var integer
     *
     * @ORM\Column(name="inversion_number", type="smallint", unique=false, nullable=true)
     */
    private $inversionNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="g_force", type="decimal", precision=2, scale=1, unique=false, nullable=true)
     */
    private $gForce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration", type="time", unique=false, nullable=true)
     */
    private $duration;

    /**
     * @var \Restraint
     *
     * @ORM\ManyToOne(targetEntity="Restraint")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="restraint_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $restraint;

    /**
     * @var \Manufacturer
     *
     * @ORM\ManyToOne(targetEntity="Manufacturer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $manufacturer;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Launch")
     * @ORM\JoinTable(name="object_coaster_launch",
     *   joinColumns={
     *     @ORM\JoinColumn(name="object_coaster_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="launch_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $launchs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Type", inversedBy="objectCoasters")
     * @ORM\JoinTable(name="object_coaster_type",
     *   joinColumns={
     *     @ORM\JoinColumn(name="object_coaster_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $types;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Coaster", mappedBy="objectCoaster")
     */
    private $coasters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->launchs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set speed
     *
     * @param string $speed
     * @return ObjectCoaster
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return ObjectCoaster
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return ObjectCoaster
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set inversionNumber
     *
     * @param integer $inversionNumber
     * @return ObjectCoaster
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
     * @param string $gForce
     * @return ObjectCoaster
     */
    public function setGForce($gForce)
    {
        $this->gForce = $gForce;

        return $this;
    }

    /**
     * Get gForce
     *
     * @return string
     */
    public function getGForce()
    {
        return $this->gForce;
    }

    /**
     * Set duration
     *
     * @param \DateTime $duration
     * @return ObjectCoaster
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
     * Set restraint
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Restraint $restraint
     * @return ObjectCoaster
     */
    public function setRestraint(\CoastersWorld\Bundle\SiteBundle\Entity\Restraint $restraint = null)
    {
        $this->restraint = $restraint;

        return $this;
    }

    /**
     * Get restraint
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Restraint
     */
    public function getRestraint()
    {
        return $this->restraint;
    }

    /**
     * Set manufacturer
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Manufacturer $manufacturer
     * @return ObjectCoaster
     */
    public function setManufacturer(\CoastersWorld\Bundle\SiteBundle\Entity\Manufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Add launchs
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Launch $launchs
     * @return ObjectCoaster
     */
    public function addLaunch(\CoastersWorld\Bundle\SiteBundle\Entity\Launch $launchs)
    {
        $this->launchs[] = $launchs;

        return $this;
    }

    /**
     * Remove launchs
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Launch $launchs
     */
    public function removeLaunch(\CoastersWorld\Bundle\SiteBundle\Entity\Launch $launchs)
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
     * Add types
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Type $types
     * @return ObjectCoaster
     */
    public function addType(\CoastersWorld\Bundle\SiteBundle\Entity\Type $types)
    {
        $this->types[] = $types;

        return $this;
    }

    /**
     * Remove types
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Type $types
     */
    public function removeType(\CoastersWorld\Bundle\SiteBundle\Entity\Type $types)
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

    /**
     * Add coasters
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coasters
     * @return ObjectCoaster
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
