<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CoastersWorld\Bundle\SiteBundle\Entity\News
 */
class News
{
    /**
     * @var integer $id
     */
    private $id;

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
     * @var CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    private $author;

    /**
     * @var CoastersWorld\Bundle\SiteBundle\Entity\Coaster
     */
    private $coaster;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $tags;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publishedAt = new \DateTime();
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
     * Set author
     *
     * @param CoastersWorld\Bundle\SiteBundle\Entity\User $author
     * @return News
     */
    public function setAuthor(\CoastersWorld\Bundle\SiteBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set coaster
     *
     * @param CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster
     * @return News
     */
    public function setCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster = null)
    {
        $this->coaster = $coaster;

        return $this;
    }

    /**
     * Get coaster
     *
     * @return CoastersWorld\Bundle\SiteBundle\Entity\Coaster
     */
    public function getCoaster()
    {
        return $this->coaster;
    }

    /**
     * Add tag
     *
     * @param CoastersWorld\Bundle\SiteBundle\Entity\Tag $tag
     * @return News
     */
    public function addTag(\CoastersWorld\Bundle\SiteBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param CoastersWorld\Bundle\SiteBundle\Entity\Tag $tag
     */
    public function removeTag(\CoastersWorld\Bundle\SiteBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tag
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add comments
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Comment $comments
     * @return News
     */
    public function addComment(\CoastersWorld\Bundle\SiteBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Comment $comments
     */
    public function removeComment(\CoastersWorld\Bundle\SiteBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}