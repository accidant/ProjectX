<?php

namespace Core\EntranceBundle\Controller;

use Core\EntranceBundle\Component\Controller\CmsControllerContainer;


/**
 * Date: 20.08.12
 * Time: 09:09
 * @author Thomas Joußen
 */
abstract class AbstractEntranceController extends CmsControllerContainer{

	protected $response = array();

	public function handleRequestAction(){
		$handledRequest = $this->handleRequest();
		return $this->render('::backend.html.twig', $handledRequest);
	}

	protected function callRequest(){
		return $this->requestedController[0]->{$this->requestedController[1]}();
	}

	protected function addToResponse($response, $controller){

	}

	/**
	 * Übernimmt die spezifischen Aufgaben eines Controllers, die zum Handeln eines Requests notwendig sind.
	 *
	 * @abstract
	 * @return mixed
	 */
	abstract protected function handleRequest();
}
