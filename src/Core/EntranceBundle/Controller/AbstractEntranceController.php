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
                if (isset($handledRequest['main_content']['method']) && $handledRequest['main_content']['method']=='redirect') {
                    return $this->redirect($handledRequest['main_content']['url']);
                } elseif (isset($handledRequest['main_content']['method']) && $handledRequest['main_content']['method']=='render') {
                    return $this->render('::backend.html.twig', $handledRequest);
                } else {
                    throw new \InvalidArgumentException("Invalid or missing argument for 'method'!");
                }
	}

	protected function callRequest(){
		return call_user_func_array($this->requestedController, $this->requestedArguments);
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
