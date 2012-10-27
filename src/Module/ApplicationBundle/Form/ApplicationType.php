<?php

namespace Module\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nickname')
            ->add('firstname')
            ->add('surname', 'text', array('required'=>false))
            ->add('age', 'number', array('required'=>false))
            ->add('email', 'text', array('required'=>false))
            ->add('skype', 'text', array('required'=>false))
            ->add('clanhistory', 'text', array('required'=>false))
            ->add('text', 'textarea', array('required'=>true))
            ->add('games')
        ;
    }

    public function getName()
    {
        return 'module_applicationbundle_applicationtype';
    }
}
