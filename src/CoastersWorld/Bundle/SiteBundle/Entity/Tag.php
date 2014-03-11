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
}
