<?php

namespace CoastersWorld\Bundle\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RatingType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        // $resolver->setDefaults(array(
        //     'choices' => array(
        //         'm' => 'Male',
        //         'f' => 'Female',
        //     )
        // ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'rating';
    }
}
