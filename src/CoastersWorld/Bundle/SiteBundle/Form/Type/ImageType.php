<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $objectManager = $options['om'];
        $builder
            ->add('coaster', 'entity', array(
                'class' => 'CoastersWorldSiteBundle:Coaster',
                'required' => false,
                'label' => 'Coaster',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->leftjoin('c.park', 'p')
                        ->addSelect('p')
                        ->orderBy('c.name', 'ASC')
                        ->addOrderBy('p.name', 'ASC')
                    ;
                },
            ))
            ->add('tags', new TagType(), array(
                'om' => $objectManager,
                'required' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'om',
        ))
        ->setAllowedTypes(array(
            'om' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    public function getName()
    {
        return 'image_type';
    }
}
