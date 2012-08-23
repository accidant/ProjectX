<?php

namespace Core\EntranceBundle\Component\Navigation;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Date: 23.08.12
 * Time: 11:48
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class Categorie {

	/**
	 * Der Name der Categorie
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * @var ArrayCollection
	 */
	protected $elements;

	public function __construct($name){
		$this->name = $name;
		$this->elements = new ArrayCollection();
	}

	/**
	 * @param ArrayCollection $elements
	 */
	public function setElements($elements){
		$this->elements = $elements;
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getElements(){
		return $this->elements;
	}

	/**
	 * @param Element $element
	 */
	public function addElement($element){
		$this->elements[] = $element;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}
