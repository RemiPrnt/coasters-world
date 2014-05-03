<?php

namespace CoastersWorld\Bundle\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{

    private $translator;

    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('username',   'text',     array(  'label' => "register.form.pseudo.label",
                                                        'attr' => array(    'rel' => "tooltip",
                                                                            'data-original-title' => $this->translator->trans("register.form.pseudo.tooltip"))))
                ->add('password',   'repeated', array(
                                                    'type' => 'password',
                                                    'invalid_message' => 'Les mots de passe doivent correspondre',
                                                    'options' => array('required' => true),
                                                    'first_options'  => array(  'label' => 'register.form.password.label',
                                                                                'attr' => array('rel' => "tooltip",
                                                                                                'data-original-title' => $this->translator->trans("register.form.password.tooltip"))),
                                                    'second_options' => array(  'label' => 'register.form.passwordConfirm.label',
                                                                                'attr' => array('rel' => "tooltip",
                                                                                                'data-original-title' => $this->translator->trans("register.form.passwordConfirm.tooltip")))))
                ->add('email',      'email',    array(  'label' => "register.form.email.label",
                                                        'attr' => array('rel' => "tooltip",
                                                                        'data-original-title' => $this->translator->trans("register.form.email.tooltip"))))
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
