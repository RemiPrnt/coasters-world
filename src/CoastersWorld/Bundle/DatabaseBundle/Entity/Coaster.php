<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\DatabaseBundle\Entity\Coaster
 */
class Coaster
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ratings;

    /**
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster
     */
    private $refCoaster;

    /**
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\Park
     */
    private $park;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Coaster
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
     * Set slug
     *
     * @param string $slug
     * @return Coaster
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Add ratings
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings
     * @return Coaster
     */
    public function addRating(\CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;

        return $this;
    }

    /**
     * Remove ratings
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings
     */
    public function removeRating(\CoastersWorld\Bundle\DatabaseBundle\Entity\Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Set refCoaster
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster $refCoaster
     * @return Coaster
     */
    public function setRefCoaster(\CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster $refCoaster = null)
    {
        $this->refCoaster = $refCoaster;

        return $this;
    }

    /**
     * Get refCoaster
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster
     */
    public function getRefCoaster()
    {
        return $this->refCoaster;
    }

    /**
     * Set park
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Park $park
     * @return Coaster
     */
    public function setPark(\CoastersWorld\Bundle\DatabaseBundle\Entity\Park $park = null)
    {
        $this->park = $park;

        return $this;
    }

    /**
     * Get park
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\Park
     */
    public function getPark()
    {
        return $this->park;
    }
    /**
     * @var \CoastersWorld\Bundle\DatabaseBundle\Entity\Status
     */
    private $status;


    /**
     * Set status
     *
     * @param \CoastersWorld\Bundle\DatabaseBundle\Entity\Status $status
     * @return Coaster
     */
    public function setStatus(\CoastersWorld\Bundle\DatabaseBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \CoastersWorld\Bundle\DatabaseBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @var float
     */
    private $rate;


    /**
     * Set rate
     *
     * @param float $rate
     * @return Coaster
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }
}