<?php

namespace System\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewsCategoryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'textarea', array(
			   'required' => false
			));
        ;
    }

    public function getName()
    {
        return 'system_newsbundle_newscategorytype';
    }
}
