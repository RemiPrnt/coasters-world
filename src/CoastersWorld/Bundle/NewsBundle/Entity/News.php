<?php

namespace CoastersWorld\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoastersWorld\Bundle\NewsBundle\Entity\News
 */
class News
{
    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var \DateTime $publishedAt
     */
    private $publishedAt;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var CoastersWorld\Bundle\NewsBundle\Entity\User
     */
    private $user;

    /**
     * @var CoastersWorld\Bundle\NewsBundle\Entity\Coaster
     */
    private $coaster;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $tag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tag = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return News
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
     * Set body
     *
     * @param string $body
     * @return News
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return News
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    
        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
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
     * Set user
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\User $user
     * @return News
     */
    public function setUser(\CoastersWorld\Bundle\NewsBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return CoastersWorld\Bundle\NewsBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set coaster
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\Coaster $coaster
     * @return News
     */
    public function setCoaster(\CoastersWorld\Bundle\NewsBundle\Entity\Coaster $coaster = null)
    {
        $this->coaster = $coaster;
    
        return $this;
    }

    /**
     * Get coaster
     *
     * @return CoastersWorld\Bundle\NewsBundle\Entity\Coaster 
     */
    public function getCoaster()
    {
        return $this->coaster;
    }

    /**
     * Add tag
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\Tag $tag
     * @return News
     */
    public function addTag(\CoastersWorld\Bundle\NewsBundle\Entity\Tag $tag)
    {
        $this->tag[] = $tag;
    
        return $this;
    }

    /**
     * Remove tag
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\Tag $tag
     */
    public function removeTag(\CoastersWorld\Bundle\NewsBundle\Entity\Tag $tag)
    {
        $this->tag->removeElement($tag);
    }

    /**
     * Get tag
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTag()
    {
        return $this->tag;
    }
}