<?php

namespace System\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle', 'textarea', array('required' => false))
            ->add('content')
            ->add('startDate', 'datetime', array('required'=>false))
            ->add('endDate', 'datetime', array('required'=>false))
            ->add('published', 'checkbox', array('required'=>false))
            ->add('commentsAllowed', 'checkbox', array('required'=>false))
            ->add('newsCategory')
        ;
    }

    public function getName()
    {
        return 'system_newsbundle_newstype';
    }
}
