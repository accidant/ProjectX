<?php

namespace System\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use System\PageBundle\Form\PageMetadataType;

/**
 * Date: 12.10.12
 * Time: 16:38
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PageType extends AbstractType{

	public function buildForm(FormBuilder $builder, array $options){
		$builder
			->add('name')
			->add('alias', 'text', array(
				'required' => false
			))
			->add('inMenu', 'checkbox', array(
				'required' => false
			))
			->add('metadata', new PageMetadataType());

	}

	public function getDefaultOptions(array $options){
		$options = parent::getDefaultOptions($options);

		$options['data_class'] = 'System\PageBundle\Entity\Page';

		return $options;
	}

	public function getName(){
		return 'system_pagebundle_pagetype';
	}

}
