<?php

namespace Core\EntranceBundle\Component\Navigation;

/**
 * Date: 23.08.12
 * Time: 14:28
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class Builder {

	public function generate($config){
		$navigation = new Navigation();
		foreach($config as $key => $controller){
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
