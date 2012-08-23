<?php

namespace Core\EntranceBundle\Component\Navigation;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Date: 23.08.12
 * Time: 11:00
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class Navigation {

	/**
	 * @var ArrayCollection
	 */
	protected $categories;

	public function __construct(){
		$this->categories = new ArrayCollection();
	}

	/**
	 * @param ArrayCollection $elements
	 */
	public function setCategories($elements){
		$this->categories = $elements;
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getCategories(){
		return $this->categories;
	}

	/**
	 * @param string $name
	 * @return \Core\EntranceBundle\Component\Navigation\Categorie
	 * @throws \InvalidArgumentException
	 */
	public function getCategoryByName($name){
		foreach($this->categories as $category){
			if($category->getName() == $name)
				return $category;
		}
		throw new \InvalidArgumentException();
	}

	/**
	 * @param Element $element
	 */
	public function addCategory($element){
		$this->categories[] = $element;
	}

}
