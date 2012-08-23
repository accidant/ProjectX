<?php

namespace Core\EntranceBundle\Controller;

use Core\EntranceBundle\Component\Navigation\Navigation;
use Core\EntranceBundle\Component\Navigation\Categorie;
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
			$category = $this->loadCategory($navigation, $controller);
			$this->addElementToCategory($key, $controller, $category);
		}

		return $navigation;
	}

	private function loadCategory($navigation, $controller) {
		try {
			$category = $navigation->getCategoryByName($controller['category']);
			return $category;
		} catch(\Exception $exception) {
			$category = new Categorie($controller['category']);
			$navigation->addCategory($category);
			return $category;
		}
	}

	private function addElementToCategory($key, $controller, $category) {
		$element = new Element();
		$element->setName($key);
		$element->setRoute($controller['route']);
		$category->addElement($element);
	}
}
