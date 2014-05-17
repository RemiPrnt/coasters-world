<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\SiteBundle\Entity\Tag
 */
class Tag
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $news;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tag
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
     * Add news
     *
     * @param CoastersWorld\Bundle\SiteBundle\Entity\News $news
     * @return Tag
     */
    public function addNew(\CoastersWorld\Bundle\SiteBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param CoastersWorld\Bundle\SiteBundle\Entity\News $news
     */
    public function removeNew(\CoastersWorld\Bundle\SiteBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add news
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\News $news
     * @return Tag
     */
    public function addNews(\CoastersWorld\Bundle\SiteBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\News $news
     */
    public function removeNews(\CoastersWorld\Bundle\SiteBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $image;


    /**
     * Add image
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Image $image
     * @return Tag
     */
    public function addImage(\CoastersWorld\Bundle\SiteBundle\Entity\Image $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Image $image
     */
    public function removeImage(\CoastersWorld\Bundle\SiteBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;


    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
