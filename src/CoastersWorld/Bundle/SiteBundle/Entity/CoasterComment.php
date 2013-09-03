<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

class CoasterComment
{    /**
     * @var string
     */
    private $body;

    /**
     * @var \DateTime
     */
    private $publishedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    private $author;

    /**
     * @var \CoastersWorld\Bundle\SiteBundle\Entity\Coaster
     */
    private $coaster;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->publishedAt = new \DateTime();
    }

    /**
     * Set body
     *
     * @param string $body
     * @return CoasterComment
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
     * @return CoasterComment
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
     * Set author
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\User $author
     * @return CoasterComment
     */
    public function setAuthor(\CoastersWorld\Bundle\SiteBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set coaster
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster
     * @return CoasterComment
     */
    public function setCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster = null)
    {
        $this->coaster = $coaster;

        return $this;
    }

    /**
     * Get coaster
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\Coaster
     */
    public function getCoaster()
    {
        return $this->coaster;
    }
}
