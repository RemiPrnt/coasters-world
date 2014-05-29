<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use CoastersWorld\Bundle\SiteBundle\Form\DataTransformer\ImageTransformer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new ImageTransformer($options['om']));
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

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'image2_type';
    }
}
