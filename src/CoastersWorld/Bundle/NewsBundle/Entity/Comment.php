<?php

namespace CoastersWorld\Bundle\NewsBundle\Entity;

/**
 * CoastersWorld\Bundle\NewsBundle\Entity\Comment
 */
class Comment
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var \DateTime $publishedAt
     */
    private $publishedAt;

    /**
     * @var CoastersWorld\Bundle\UserBundle\Entity\User
     */
    private $author;

    /**
     * @var CoastersWorld\Bundle\NewsBundle\Entity\News
     */
    private $news;


    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set body
     *
     * @param string $body
     * @return Comment
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
     * @return Comment
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
     * @param CoastersWorld\Bundle\UserBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\CoastersWorld\Bundle\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return CoastersWorld\Bundle\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set news
     *
     * @param CoastersWorld\Bundle\NewsBundle\Entity\News $news
     * @return Comment
     */
    public function setNews(\CoastersWorld\Bundle\NewsBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return CoastersWorld\Bundle\NewsBundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }
}
