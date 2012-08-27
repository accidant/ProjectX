<?php

namespace Core\EntranceBundle\EventListeners;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Core\CoreBaseBundle\Component\Controller\InformationService;


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
		if ($this->isChangeable($event))
			$this->swapController($event);
	}

	/**
	 * Überprüft ob der Request einen Tausch des eigentlichen Controller erlaubt.
	 * Zum einen muss es der Hauptrequest sein und es darf keine Ajax anfrage sein.
	 * Ebenfalls wird überprüft ob es ein von Symfony umgeleiteter Request auf den SecurityController ist,
	 * weil ein Login benötigt wird. Dann wird ebenfall der Controller direkt angesteuert.
	 *
	 * @param FilterControllerEvent $event
	 * @return bool
	 */
	private function isChangeable(FilterControllerEvent $event) {
		$controller = $event->getController();
		return	HttpKernelInterface::MASTER_REQUEST == $event->getRequestType() &&
				!$event->getRequest()->isXmlHttpRequest() &&
				!($controller[0] instanceof \Core\SecurityBundle\Controller\SecurityController &&
				$controller[1] == 'loginAction') &&
				!($controller[0] instanceof \Core\EntranceBundle\Controller\AbstractEntranceController);
	}

	/**
	 * Tauscht den eigentlichen Controller gegen den Einstiegscontroller aus, der die gesamte
	 * Funktionalität des CMS einleitet
	 *
	 * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
	 */
	private function swapController(FilterControllerEvent $event) {
		$controller = $event->getController();

		if($controller[0] instanceof \Core\CoreBaseBundle\Controller\AbstractModuleController)
			$controller[0]->setInformationService(new InformationService());

		$handleController = 'FrontendEntranceController';
		if($this->isBackendRequest($event->getRequest()))
			$handleController = 'BackendEntranceController';

		$requestController = $this->initializeHandleController($handleController);
		$requestController->setRequestController($controller);

		$this->resolveControllerArguments($event, $controller, $requestController);

		$event->setController(array($requestController, 'handleRequestAction'));
	}

	/**
	 * Lädt die Argumente für den momentanen Request mithilfe aus von einem Resolver und setzt sie im überschribenden Controller
	 * um sie später an den eigentlichen Controller zu übergeben
	 *
	 * @param FilterControllerEvent $event
	 * @param Controller $controller
	 * @param Controller $requestController
	 */
	private function resolveControllerArguments($event, $controller, $requestController) {
		$resolver = new \Symfony\Component\HttpKernel\Controller\ControllerResolver();
		$arguments = $resolver->getArguments($event->getRequest(), $controller);
		$requestController->setRequestedArguments($arguments);
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
		$controller->setInformationService(new InformationService());
		return $controller;
	}
}
