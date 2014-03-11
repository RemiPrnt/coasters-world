<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
        ;
    }

    public function getName()
    {
        return 'news_type';
    }
}
