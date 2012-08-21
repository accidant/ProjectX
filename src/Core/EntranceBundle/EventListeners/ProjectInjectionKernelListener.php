<?php

namespace Core\EntranceBundle\EventListeners;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\DependencyInjection\ContainerAware;


/**
 * Date: 03.08.12
 * Time: 12:23
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class ProjectInjectionKernelListener extends ContainerAware {

	/**
	 * Der Kernvelevent Listener der auf das kernel.controller event wartet und sich einhängt, bevor der eigentliche
	 * Controller ausgeführt wird.
	 *
	 * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
	 */
	public function onKernelController(FilterControllerEvent $event){
		$test = $event->getRequestType();
		if ($this->isChangeable($event))
			$this->swapController($event);
	}

	/**
	 * Überprüft ob der Request einen Tausch des eigentlichen Controller erlaubt.
	 * Zum einen muss es der Hauptrequest sein und es darf keine Ajax anfrage sein.
	 *
	 * @param FilterControllerEvent $event
	 * @return bool
	 */
	private function isChangeable(FilterControllerEvent $event) {
		return	HttpKernelInterface::MASTER_REQUEST == $event->getRequestType() &&
				!$event->getRequest()->isXmlHttpRequest();
	}

	/**
	 * Tauscht den eigentlichen Controller gegen den Einstiegscontroller aus, der die gesamte
	 * Funktionalität des CMS einleitet
	 *
	 * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
	 */
	private function swapController(FilterControllerEvent $event) {
		$controller = $event->getController();

		$handleController = 'FrontendEntranceController';
		if($this->isBackendRequest($event->getRequest()))
			$handleController = 'BackendEntranceController';

		$requestController = $this->initializeHandleController($handleController);
		$requestController->setRequestController($controller);
		$event->setController(array($requestController, 'handleRequestAction'));
	}

	/**
	 * Überprüft ob aus der URL hervorgeht, dass es sich um eine Backend-Aktion handelt
	 *
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return boolean
	 */
	private function isBackendRequest(\Symfony\Component\HttpFoundation\Request $request){
		return (boolean)\preg_match('|/admin/.*|', $request->getPathInfo());
	}

	/**
	 * Initialisiert den Controller der die Steuerung des Backend/Frontends übernimmt
	 *
	 * @param string $controllerName
	 * @return mixed
	 */
	private function initializeHandleController($controllerName){
		$controllerName = 'Core\EntranceBundle\Controller\\' . $controllerName;
		$controller = new $controllerName();
		$controller->setContainer($this->container);
		return $controller;
	}
}
