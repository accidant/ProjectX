<?php

namespace Core\EntranceBundle\EventListeners;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Core\EntranceBundle\Controller\EntranceController;


/**
 * Date: 03.08.12
 * Time: 12:23
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 */
class ProjectInjectionKernelListener {

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
		$requestController = new EntranceController();
		$requestController->setRequestController($controller);
		$event->setController(array($requestController, 'handleRequestAction'));
	}
}
