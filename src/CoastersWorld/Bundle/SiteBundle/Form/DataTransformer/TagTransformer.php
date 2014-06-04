<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\DataTransformer;

use CoastersWorld\Bundle\SiteBundle\Entity\Tag;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\PersistentCollection;

use Symfony\Component\Form\DataTransformerInterface;

class TagTransformer implements DataTransformerInterface
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
      * Transforme la collection de tags en string "tag1,tag2".
      */
    public function transform($tags)
    {
        if (!$tags instanceof PersistentCollection) {
            return '';
        }

        // On transforme en array
        $tags = $tags->toArray();

        return implode(',', $tags);
    }

    /**
      * Transforme une string "tag1,tag2" en ArrayCollection pour doctrine.
      */
    public function reverseTransform($tags)
    {
        if (!$tags) {
            $tags = '';
        }

         // On transforme la string en array.
        $tags = array_filter(array_map('trim', explode(',', $tags)));

        $collection = new ArrayCollection();

        // Pour chaque valeur, on récupère l'objet existant en base.
        foreach ($tags as $name) {
            $tag = $this->om
                ->getRepository('CoastersWorldSiteBundle:Tag')
                ->findOneBy(array('name' => $name))
            ;

            // Dans le cas ou il n'existe pas, on crée un nouvel objet Tag.
            if (is_null($tag)) {
                $tag = new Tag();
                $tag->setName($name);
            }

            $collection->add($tag);
        }

        return $collection;
    }
}
