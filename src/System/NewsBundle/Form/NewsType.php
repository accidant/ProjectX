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
            ->add('subtitle')
            ->add('content')
            ->add('startDate')
            ->add('endDate')
            ->add('published')
            ->add('commentsAllowed')
            ->add('createDate')
            ->add('updateDate')
            ->add('hidden')
            ->add('deleted')
            ->add('newsCategory')
        ;
    }

    public function getName()
    {
        return 'system_newsbundle_newstype';
    }
}
