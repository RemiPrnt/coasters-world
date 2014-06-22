<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Coaster
 *
 * @ORM\Table(name="coaster")
 * @ORM\Entity(repositoryClass="CoastersWorld\Bundle\SiteBundle\Entity\Repository\CoasterRepository")
 */
class Coaster
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
     * @ORM\Column(name="name", type="string", length=255, unique=false, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true, nullable=false)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="opening_date", type="date", unique=false, nullable=true)
     */
    private $openingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closing_date", type="date", unique=false, nullable=true)
     */
    private $closingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="average_rating", type="decimal", precision=5, scale=3, unique=false, nullable=true)
     */
    private $averageRating;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $status;

    /**
     * @var \Park
     *
     * @ORM\ManyToOne(targetEntity="Park", inversedBy="coasters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="park_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $park;

    /**
     * @var \ObjectCoaster
     *
     * @ORM\ManyToOne(targetEntity="ObjectCoaster", inversedBy="coasters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_coaster_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $objectCoaster;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="coasters")
     * @ORM\JoinTable(name="coaster_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="coaster_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $users;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="coaster")
     */
    private $articles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Image", mappedBy="coaster")
     */
    private $images;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="coaster")
     */
    private $ratings;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Feedback", mappedBy="coaster")
     */
    private $feedbacks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        $name = $this->name;
        if(!is_null($this->park)) {
            $name .= ' (' . $this->park->getName() . ')';
        }

        return $name;
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
     * @param  string  $name
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
     * @param  string  $slug
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
     * Set openingDate
     *
     * @param  \DateTime $openingDate
     * @return Coaster
     */
    public function setOpeningDate($openingDate)
    {
        $this->openingDate = $openingDate;

        return $this;
    }

    /**
     * Get openingDate
     *
     * @return \DateTime
     */
    public function getOpeningDate()
    {
        return $this->openingDate;
    }

    /**
     * Set closingDate
     *
     * @param  \DateTime $closingDate
     * @return Coaster
     */
    public function setClosingDate($closingDate)
    {
        $this->closingDate = $closingDate;

        return $this;
    }

    /**
     * Get closingDate
     *
     * @return \DateTime
     */
    public function getClosingDate()
    {
        return $this->closingDate;
    }

    /**
     * Set averageRating
     *
     * @param  string  $averageRating
     * @return Coaster
     */
    public function setAverageRating($averageRating)
    {
        $this->averageRating = $averageRating;

        return $this;
    }

    /**
     * Get averageRating
     *
     * @return string
     */
    public function getAverageRating()
    {
        return $this->averageRating;
    }

    /**
     * Set status
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Status $status
     * @return Coaster
     */
    public function setStatus(\CoastersWorld\Bundle\SiteBundle\Entity\Status $status)
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
     * Set park
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Park $park
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
     * Set objectCoaster
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster $objectCoaster
     * @return Coaster
     */
    public function setObjectCoaster(\CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster $objectCoaster)
    {
        $this->objectCoaster = $objectCoaster;

        return $this;
    }

    /**
     * Get objectCoaster
     *
     * @return \CoastersWorld\Bundle\SiteBundle\Entity\ObjectCoaster
     */
    public function getObjectCoaster()
    {
        return $this->objectCoaster;
    }

    /**
     * Add users
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\User $users
     * @return Coaster
     */
    public function addUser(\CoastersWorld\Bundle\SiteBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\User $users
     */
    public function removeUser(\CoastersWorld\Bundle\SiteBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add articles
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Article $articles
     * @return Coaster
     */
    public function addArticle(\CoastersWorld\Bundle\SiteBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Article $articles
     */
    public function removeArticle(\CoastersWorld\Bundle\SiteBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add images
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Image $images
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
     * Add ratings
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Rating $ratings
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
     * Add feedbacks
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Feedback $feedbacks
     *
     * @return Coaster
     */
    public function addFeedback(\CoastersWorld\Bundle\SiteBundle\Entity\Feedback $feedbacks)
    {
        $this->feedbacks[] = $feedbacks;

        return $this;
    }

    /**
     * Remove feedbacks
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Feedback $feedbacks
     */
    public function removeFeedback(\CoastersWorld\Bundle\SiteBundle\Entity\Feedback $feedbacks)
    {
        $this->feedbacks->removeElement($feedbacks);
    }

    /**
     * Get feedbacks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbacks()
    {
        return $this->feedbacks;
    }
}
