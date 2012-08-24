<?php

namespace Core\EntranceBundle\Component\Navigation;

/**
 * Date: 23.08.12
 * Time: 10:58
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class Element {

	/**
	 * Der Name des Navigationselement
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Der Name der Route des Navigationselements
	 *
	 * @var string
	 */
	protected $route;

	/**
	 * @var boolean
	 */
	protected $active = false;

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

	/**
	 * @param string $route
	 */
	public function setRoute($route) {
		$this->route = $route;
	}

	/**
	 * @return string
	 */
	public function getRoute() {
		return $this->route;
	}

	/**
	 * @param boolean $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @return boolean
	 */
	public function isActive() {
		return $this->active;
	}
}
