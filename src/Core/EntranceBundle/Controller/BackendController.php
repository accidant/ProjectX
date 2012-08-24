<?php

namespace Core\EntranceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Date: 20.08.12
 * Time: 09:36
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 *
 */
class BackendController extends Controller {

	public function indexAction(){
		return 'CoreEntranceBundle:Test:index.html.twig';
	}

	public function testAction(){
		 return 'CoreEntranceBundle:Test:test.html.twig';
	}

	public function tableAction(){
		return 'CoreEntranceBundle:Test:table.html.twig';
	}
}
