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
class TestController extends Controller {

	public function indexAction(){
		$core_configuration = $this->container->parameters['core_entrance'];
		print_r($core_configuration);
		exit;
		return true;
	}
}
