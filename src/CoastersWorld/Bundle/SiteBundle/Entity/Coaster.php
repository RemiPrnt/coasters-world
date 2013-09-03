<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\SiteBundle\Entity\Coaster
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
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster
     */
    private $refCoaster;

    /**
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\Park
     */
    private $park;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name . ' (' . $this->park->getName() . ')';
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
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Rating $ratings
     * @return Coaster
     */
    public function addRating(\CoastersWorld\Bundle\SiteBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;

        return $this;
    }

    /**
     * Remove ratings
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Rating $ratings
     */
    public function removeRating(\CoastersWorld\Bundle\SiteBundle\Entity\Rating $ratings)
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
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster $refCoaster
     * @return Coaster
     */
    public function setRefCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster $refCoaster = null)
    {
        $this->refCoaster = $refCoaster;

        return $this;
    }

    /**
     * Get refCoaster
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster
     */
    public function getRefCoaster()
    {
        return $this->refCoaster;
    }

    /**
     * Set park
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Park $park
     * @return Coaster
     */
    public function setPark(\CoastersWorld\Bundle\SiteBundle\Entity\Park $park = null)
    {
        $this->park = $park;

        return $this;
    }

    /**
     * Get park
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Park
     */
    public function getPark()
    {
        return $this->park;
    }
    /**
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\Status
     */
    private $status;


    /**
     * Set status
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Status $status
     * @return Coaster
     */
    public function setStatus(\CoastersWorld\Bundle\SiteBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Status
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;


    /**
     * Add images
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Image $images
     * @return Coaster
     */
    public function addImage(\CoastersWorld\Bundle\SiteBundle\Entity\Image $images)
    {
        $this->images[] = $images;
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Image $images
     */
    public function removeImage(\CoastersWorld\Bundle\SiteBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $coasterComments;


    /**
     * Add coasterComments
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\CoasterComment $coasterComments
     * @return Coaster
     */
    public function addCoasterComment(\CoastersWorld\Bundle\SiteBundle\Entity\CoasterComment $coasterComments)
    {
        $this->coasterComments[] = $coasterComments;
    
        return $this;
    }

    /**
     * Remove coasterComments
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\CoasterComment $coasterComments
     */
    public function removeCoasterComment(\CoastersWorld\Bundle\SiteBundle\Entity\CoasterComment $coasterComments)
    {
        $this->coasterComments->removeElement($coasterComments);
    }

    /**
     * Get coasterComments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoasterComments()
    {
        return $this->coasterComments;
    }
}