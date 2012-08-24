<?php

namespace Core\EntranceBundle\Component\Navigation;

/**
 * Date: 23.08.12
 * Time: 14:28
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class Builder {

	protected $route;

	public function __construct($route){
		$this->route = $route;
	}

	public function generate($config, $selectedCategory = ''){
		$navigation = new Navigation();
		foreach($config as $key => $controller){
			$category = $this->loadCategory($navigation, $controller);
			if(\strtolower($category->getName()) == $selectedCategory ||  $controller['route'] == $this->route)
				$category->setActive(true);

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
		if($this->route == $controller['route'])
			$element->setActive(true);

		$category->addElement($element);
	}

}
