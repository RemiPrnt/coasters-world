<?php

namespace CoastersWorld\Bundle\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('body', 'textarea');
        $builder->add('publishedAt', 'datetime', array(
            'input'  => 'datetime',
            'widget' => 'choice',
            'date_format' => 'd/MMMM/y',
        ));
        $builder->add('user', 'entity', array(
            'class' => 'CoastersWorldNewsBundle:User',
            'property' => 'username',
        ));
    }

    public function getName()
    {
        return 'news_type';
    }
}
