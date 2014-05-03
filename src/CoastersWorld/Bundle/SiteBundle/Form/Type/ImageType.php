<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

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
                'label' => 'Coaster'
            ))
            ->add('tags', new TagType(), array(
                'om' => $objectManager,
                'required' => false
            ))
            ->add('save', 'submit')
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
