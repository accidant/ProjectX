<?php

namespace System\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Date: 12.10.12
 * Time: 16:42
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PageMetadataType extends AbstractType{

	public function buildForm(FormBuilder $builder, array $options){
		$builder
			->add('title')
			->add('description', 'textarea', array(
				'required' => false
			));
	}

	public function getDefaultOptions(array $options){
		$options = parent::getDefaultOptions($options);

		$options['data_class'] = 'System\PageBundle\Entity\PageMetadata';

		return $options;
	}

	public function getName(){
		return 'system_pagebundle_pagemetadata';
	}
}
