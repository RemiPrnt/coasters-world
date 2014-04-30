<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username',   'text',     array('label' => "register.form.pseudo"))
                ->add('password',   'repeated', array(
                                                    'type' => 'password',
                                                    'invalid_message' => 'Les mots de passe doivent correspondre',
                                                    'options' => array('required' => true),
                                                    'first_options'  => array('label' => 'register.form.password'),
                                                    'second_options' => array('label' => 'register.form.passwordConfirm'),
                                                )
                )
                ->add('email',      'email',    array('label' => "register.form.email"))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoastersWorld\Bundle\SiteBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coastersworld_bundle_sitebundle_user';
    }
}
