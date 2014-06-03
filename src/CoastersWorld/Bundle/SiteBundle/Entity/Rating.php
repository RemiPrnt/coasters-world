<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity
 */
class Rating
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
     * @ORM\Column(name="value", type="decimal", precision=4, scale=3, unique=false, nullable=false)
     */
    private $value;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Coaster
     *
     * @ORM\ManyToOne(targetEntity="Coaster", inversedBy="ratings")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coaster_id", referencedColumnName="id")
     * })
     */
    private $coaster;



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
     * Set value
     *
     * @param string $value
     * @return Rating
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set user
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\User $user
     * @return Rating
     */
    public function setUser(\CoastersWorld\Bundle\SiteBundle\Entity\User $user = null)
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

    /**
     * Set coaster
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster
     * @return Rating
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
