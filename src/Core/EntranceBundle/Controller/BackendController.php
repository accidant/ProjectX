<?php

namespace Core\EntranceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBaseBundle\Controller\AbstractModuleController;

/**
 * Date: 20.08.12
 * Time: 09:36
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 *
 */
class BackendController extends AbstractModuleController{

	public function indexAction(){
		return array(
			'_method'    => 'render',
			'_template' => 'CoreEntranceBundle:Test:index.html.twig'
		);
	}

	public function testAction(){
		return array(
			'_method'    => 'render',
			'_template' => 'CoreEntranceBundle:Test:test.html.twig'
		);
	}

	public function tableAction(){
		return array(
			'_method'    => 'render',
			'_template' => 'CoreEntranceBundle:Test:table.html.twig'
		);
	}

	public function formAction(){
		return array(
                    'method' => 'render',
                    'blubb'  => 'blaa'
                );
	}
}
