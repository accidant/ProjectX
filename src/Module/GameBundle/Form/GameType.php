<?php

namespace Module\GameBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GameType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('icon', 'text', array('required'=>false))
            ->add('url', 'text', array('required'=>false))
        ;
    }

    public function getName()
    {
        return 'module_gamebundle_gametype';
    }
}
