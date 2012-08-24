<?php

namespace Core\EntranceBundle\Controller;

use Core\EntranceBundle\Component\Navigation\Builder;


/**
 * Date: 20.08.12
 * Time: 09:09
 * @author Thomas Joußen
 */
class BackendEntranceController extends AbstractEntranceController{

	/**
	 * Übernimmt die spezifischen Aufgaben eines Controllers, die zum Handeln eines Requests notwendig sind.
	 *
	 * @return mixed
	 */
	protected function handleRequest() {
		$response['main_content'] = $this->callRequest();
		$response['navigation'] = $this->generateBackendMenu();
		return $response;
	}

	public function selectCategoryAction($category){
		$response['navigation'] = $this->generateBackendMenu($category);
		return $this->render('::backend.html.twig', $response);
	}

	public function generateBackendMenu($category = ''){
		$config = $this->container->getParameter('core_entrance');

		$route = null;
		if($this->requestedController != null)
			$route = $this->requestedController[0]->getRequest()->get('_route');

		$builder = new Builder($route);

		return $builder->generate($config['backend']['controller'], $category);
	}
}
