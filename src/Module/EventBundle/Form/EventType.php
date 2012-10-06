<?php

namespace Module\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EventType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'text', array('required'=>false))
            ->add('date')
        ;
    }

    public function getName()
    {
        return 'module_eventbundle_eventtype';
    }
}
