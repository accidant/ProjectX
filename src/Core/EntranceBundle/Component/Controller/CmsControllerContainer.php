<?php

namespace Core\EntranceBundle\Component\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Date: 20.08.12
 * Time: 11:30
 * @author Thomas Joußen
 */
abstract class CmsControllerContainer extends Controller{

	protected $requestedController;

	/**
	 * Fügt den eigentlichen Controller aus dem Request dem Controller der als Einstieg in das
	 * CMS dienen soll hinzu
	 *
	 * @param $controller
	 */
	public function setRequestController($controller){
		$this->requestedController = $controller;
	}
}
