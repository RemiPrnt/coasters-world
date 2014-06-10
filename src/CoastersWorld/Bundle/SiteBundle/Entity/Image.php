<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="CoastersWorld\Bundle\SiteBundle\Entity\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @ORM\Column(name="path", type="string", length=255, unique=true, nullable=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", unique=false, nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", unique=false, nullable=false)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean", unique=false, nullable=false)
     */
    private $visible = true;

    /**
     * @var \Coaster
     *
     * @ORM\ManyToOne(targetEntity="Coaster", inversedBy="images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coaster_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $coaster;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="images")
     * @ORM\JoinTable(name="image_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $tags;

    private $file;
    private $temp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path (update)
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
            $this->updatedAt = new \DateTime();
        } else {
            $this->path = 'initial';
            $this->createdAt = $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));
            //$this->name = $filename;
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'media/image';
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
     * Set path
     *
     * @param  string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Image
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Image
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set visible
     *
     * @param  boolean $visible
     * @return Image
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set coaster
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Coaster $coaster
     * @return Image
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

    /**
     * Add tags
     *
     * @param  \CoastersWorld\Bundle\SiteBundle\Entity\Tag $tags
     * @return Image
     */
    public function addTag(\CoastersWorld\Bundle\SiteBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \CoastersWorld\Bundle\SiteBundle\Entity\Tag $tags
     */
    public function removeTag(\CoastersWorld\Bundle\SiteBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
