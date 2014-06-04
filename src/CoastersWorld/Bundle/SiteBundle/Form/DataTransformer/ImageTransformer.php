<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\DataTransformer;

use CoastersWorld\Bundle\SiteBundle\Entity\Image;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\DataTransformerInterface;

class ImageTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
      * Transforme une image en string
      */
    public function transform($image)
    {
        if (!$image instanceof Image) {
            return '';
        }

        return $image->getId();
    }

    /**
      * Transforme une string "tag1,tag2" en ArrayCollection pour doctrine.
      */
    public function reverseTransform($id)
    {
        if (!$id) {
            $image = null;
        }

        $image = $this->om
            ->getRepository('CoastersWorldSiteBundle:Image')
            ->findOneById($id)
       ;

       return $image;
    }
}
