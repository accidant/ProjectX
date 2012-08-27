<?php

namespace Core\EntranceBundle\Component\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBaseBundle\Controller\AbstractModuleController;

/**
 * Date: 20.08.12
 * Time: 11:30
 * @author Thomas Joußen
 */
abstract class CmsControllerContainer extends AbstractModuleController{

	protected $requestedController;

	protected $requestedArguments;

	/**
	 * Fügt den eigentlichen Controller aus dem Request dem Controller der als Einstieg in das
	 * CMS dienen soll hinzu
	 *
	 * @param $controller
	 */
	public function setRequestController($controller){
		$this->requestedController = $controller;
	}

	public function setRequestedArguments($arguments){
		$this->requestedArguments = $arguments;
	}
}
