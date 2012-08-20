<?php

namespace Core\EntranceBundle\Component\Controller;

/**
 * Date: 20.08.12
 * Time: 11:30
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 */
abstract class CmsControllerContainer {

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
