<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value', new RatingType());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoastersWorld\Bundle\SiteBundle\Entity\Rating'
        ));
    }

    public function getName()
    {
        return 'coastersworld_bundle_databasebundle_testtype';
    }
}
