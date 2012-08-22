<?php

namespace Core\EntranceBundle\Controller;

use Core\EntranceBundle\Component\Controller\CmsControllerContainer;


/**
 * Date: 20.08.12
 * Time: 09:09
 * @author Thomas Joußen
 */
abstract class AbstractEntranceController extends CmsControllerContainer{

	public function handleRequestAction(){
		return $this->handleRequest();
	}

	protected function callRequest(){
		$response = $this->requestedController[0]->{$this->requestedController[1]}();
		var_dump($this->requestedController[0]);
		exit;
	}

	/**
	 * Übernimmt die spezifischen Aufgaben eines Controllers, die zum Handeln eines Requests notwendig sind.
	 *
	 * @abstract
	 * @return mixed
	 */
	abstract protected function handleRequest();
}
