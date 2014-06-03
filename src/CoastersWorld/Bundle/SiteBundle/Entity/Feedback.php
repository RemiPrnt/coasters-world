<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity
 */
class Feedback
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
     * @ORM\Column(name="body", type="text", unique=false, nullable=false)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", unique=false, nullable=false)
     */
    private $publishedAt;

    /**
     * @var \Coaster
     *
     * @ORM\ManyToOne(targetEntity="Coaster")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coaster_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $coaster;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

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
     * @return Feedback
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
     * @return Feedback
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
     * Set coaster
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster
     * @return Feedback
     */
    public function setCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster)
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

    /**
     * Set user
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\User $user
     * @return Feedback
     */
    public function setUser(\CoastersWorld\Bundle\SiteBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
