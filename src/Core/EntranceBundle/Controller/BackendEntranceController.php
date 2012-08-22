<?php

namespace Core\EntranceBundle\Controller;

/**
 * Date: 20.08.12
 * Time: 09:09
 * @author Thomas Joußen
 */
class BackendEntranceController extends AbstractEntranceController{

	/**
	 * Übernimmt die spezifischen Aufgaben eines Controllers, die zum Handeln eines Requests notwendig sind.
	 *
	 * @return mixed
	 */
	protected function handleRequest() {
		return $this->callRequest();
	}

	public function indexAction(){
		return array('welcome' => "Wilkommen im Backend");
	}
}
