<?php

namespace Core\EntranceBundle\Component\Request;
/**
 * Date: 03.08.12
 * Time: 13:32
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 */
abstract class AbstractRequestHandler {

	/**
	 * @var Symfony\Bundle\FrameworkBundle\Controller\Controller
	 */
	protected $controller;

	/**
	 * @param Symfony\Bundle\FrameworkBundle\Controller\Controller $controller
	 */
	public function __construct(Symfony\Bundle\FrameworkBundle\Controller\Controller $controller){
		$this->controller = $controller;
	}

	public function handleRequest(){
		$this->arrangeRequest();
	}

	/**
	 * Arrangiert die Art, wie der Request abgearbeitet werden soll
	 *
	 * @abstract
	 * @return mixed
	 */
	abstract protected function arrangeRequest();
}