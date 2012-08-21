<?php

namespace Core\InstallingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SetupController extends Controller{

	public function setup(){
		$this->container->setParameter('is_setup', true);
	}
}
