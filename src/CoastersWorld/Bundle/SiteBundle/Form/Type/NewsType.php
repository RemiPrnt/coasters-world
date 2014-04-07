<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $objectManager = $options['om'];
        $builder
            ->add('title', 'text', array(
                'label' => 'Titre',
            ))
            ->add('body', 'textarea', array(
                'label' => 'Corps',
            ))
            ->add('coaster', 'entity', array(
                'class' => 'CoastersWorldSiteBundle:Coaster',
                'required' => false,
                'label' => 'Coaster'
            ))
            ->add('thumbnail', 'entity', array(
                'class' => 'CoastersWorldSiteBundle:Image',
                'required' => false,
                'label' => 'Image à la une'
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
        return 'news_type';
    }
}
