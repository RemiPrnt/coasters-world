<?php

namespace CoastersWorld\Bundle\NewsBundle\Entity;

/**
 * CoastersWorld\Bundle\NewsBundle\Entity\Comment
 */
class Comment
{
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
     * @var CoastersWorld\Bundle\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var CoastersWorld\Bundle\NewsBundle\Entity\News
     */
    private $news;


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
     * @param CoastersWorld\Bundle\UserBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\CoastersWorld\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return CoastersWorld\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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
