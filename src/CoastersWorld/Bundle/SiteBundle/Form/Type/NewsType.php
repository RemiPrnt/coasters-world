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
                'label' => 'test',
            ))
            ->add('body', 'textarea', array(
                'label' => 'test',
            ))
            ->add('publishedAt', 'datetime', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'date_format' => 'd/MMMM/y',
            ))
            ->add('author', 'entity', array(
                'class' => 'CoastersWorldSiteBundle:User',
                'property' => 'username',
                'label' => 'test',
            ))
        ;
    }

    public function getName()
    {
        return 'news_type';
    }
}
