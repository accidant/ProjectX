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
	protected $elements;

	public function __construct(){
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

}
