<?php

namespace Core\CoreBaseBundle\Component\Controller;

/**
 * Date: 27.08.12
 * Time: 15:13
 * @author Thomas Joußen <tjoussen@databay.de>
 */
abstract class AbstractInformationService {

	/**
	 * Der Namespace in welchem sich das Bundle des Controllers befindet
	 * @var string
	 */
	protected $namespace;

	/**
	 * Das Bundle in welchem sich der Controller befindet
	 * @var string
	 */
	protected $bundle;

	/**
	 * Die eigentliche Controllerklasse
	 * @var string
	 */
	protected $controller;

	/**
	 * Der Controller/die Action die aufgerufen wird
	 * @var string
	 */
	protected $action;

	/**
	 * Zerlegt die einzelnen Inhalte aus dem Request und trägt diese in den InformationenService
	 * ein
	 *
	 * @param $container
	 */
	public function generate($container){
		$matches = $this->findMatchedElements($container);
		$this->setMatchedElements($matches);
	}

	/**
	 * Gibt den kompletten Informationsstring aus dem Request zurück
	 *
	 * @return string
	 */
	public function getFullInformationString(){
		return	$this->namespace.
			$this->bundle.'Bundle'.':'.
			$this->controller.':'.
			$this->action;
	}

	/**
	 * Gibt den kompletten Controllernamen in der Form
	 * [namespace][bundle]Bundle:[controller]
	 * zurück
	 *
	 * @return string
	 */
	public function getFullControllerName(){
		return $this->namespace.
			$this->bundle.'Bundle'.':'.
			$this->controller;
	}

	/**
	 * Gibt den Namesspace des Bundles zurück, in welchem sich der Controller
	 * befindet
	 *
	 * @return string
	 */
	public function getNamespace(){
		return $this->namespace;
	}

	/**
	 * Gibt das Bundle zurück, in welchem sich der Controller befindet
	 *
	 * @return string
	 */
	public function getBundle(){
		return $this->bundle;
	}

	/**
	 * Gibt den Namen der Controllerklasse zurücl
	 *
	 * @return string
	 */
	public function getController(){
		return $this->controller;
	}

	/**
	 * Gibt den eigentlichen Controller/die Action die aufgerufen wird, zurück
	 * @return string
	 */
	public function getAction(){
		return $this->action;
	}

	/**
	 * Gibt den Entityname zurück
	 *
	 * @return string
	 */
	public function getEntityName(){
		return $this->namespace . '\\' . $this->bundle . 'Bundle\\Entity\\' . $this->controller;
	}

	/**
	 * Setzt alle gefundenen Matches in die Klassenattribute
	 */
	protected function setMatchedElements($matches){
		$this->namespace = $matches[1];
		$this->bundle = $matches[2];
		$this->controller = $matches[3];
		$this->action = $matches[4];
	}

	/**
	 * Findet aus dem Container die benötigten Elemente für den Request und gibt diese in einem Array zurück
	 *
	 * @abstract
	 * @param ContainerAware $container
	 * @return array
	 */
	abstract protected function findMatchedElements($container);
}