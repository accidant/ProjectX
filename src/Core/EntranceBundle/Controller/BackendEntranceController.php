<?php

namespace Core\EntranceBundle\Controller;

use Core\EntranceBundle\Component\Navigation\Navigation;
use Core\EntranceBundle\Component\Navigation\Element;

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
		$response = $this->callRequest();
		$response['navigation'] = $this->generateBackendMenu();
		return $response;
	}

	public function indexAction(){
		return array('welcome' => "Wilkommen im Backend");
	}

	private function generateBackendMenu(){
		$config = $this->container->getParameter('core_entrance');

		$navigation = new Navigation();
		foreach($config['backend']['controller'] as $key => $controller){
			$element = new Element();
			$element->setName($key);
			$element->setRoute($controller['route']);
			$navigation->addElement($element);
		}

		return $navigation;
	}
}
