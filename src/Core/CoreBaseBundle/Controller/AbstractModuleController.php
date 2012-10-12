<?php
namespace Core\CoreBaseBundle\Controller;

use Core\CoreBaseBundle\Component\Controller\AbstractInformationService;
use Core\CoreBaseBundle\Component\Controller\InformationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Date: 27.08.12
 * Time: 15:10
 * @author Thomas Joußen <tjoussen@databay.de>
 * @abstract
 */
abstract class AbstractModuleController extends Controller {

	/**
	 * @var \Core\CoreBaseBundle\Component\Controller\AbstractInformationService
	 */
	protected $informationService;

	/**
	 * @todo Dokumentieren
	 * @param \Core\CoreBaseBundle\Component\Controller\AbstractInformationService $service
	 */
	public function setInformationService(AbstractInformationService $service){
		$this->informationService = $service;
		$this->informationService->generate($this->container);
	}

	/**
	 * @todo Dokumentieren
	 * @return \Core\CoreBaseBundle\Component\Controller\AbstractInformationService
	 */
	public function getInformationService(){
		return $this->informationService;
	}

	/**
	 * Trys to find multiple entity from the delivered Repository by the delivered elements
	 *
	 * @param array $elements
	 * @param string $repository
	 * @return array
	 */
	public function findBy(array $elements, $repository = ''){
		$repository = $this->getRepositoryName($repository);

		$entity = $this->getDoctrine()->getRepository($repository)->findBy($elements);
		$this->throwExceptionIfNull($entity);

		return $entity;
	}

	/**
	 * Trys to find an entity from the delivered Repository by the delivered elements
	 *
	 * @param array $elements
	 * @param string $repository
	 * @return object
	 */
	public function findOneBy(array $elements, $repository = ''){
		$repository = $this->getRepositoryName($repository);

		$entity = $this->getDoctrine()->getRepository($repository)->findOneBy($elements);
		$this->throwExceptionIfNull($entity);

		return $entity;
	}

	private function getRepositoryName($repository){
		if($repository == ''){
			$repository = $this->getInformationService()->getFullControllerName();
			$strpos = \strrpos($repository, "Backend");

			if (false !== $strpos){
				$repository = \substr($repository, $strpos);
			}

			return $repository;
		}

		return $repository;
	}

	/**
	 * Throws an Exception if the delivered entity is NULL
	 *
	 * @param BaseEntity $entity
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	protected function throwExceptionIfNull($entity){
		if ($entity == null) {
			throw $this->createNotFoundException('Unable to find NewsCategory entity.');
		}
	}

	/**
	 * Generates an array which is required for a view
	 *
	 * @param array $params
	 * @param null|string $template
	 * @return array
	 */
	public function generateView(array $params, $template = null){
		return $this->renderer('render', $params, $template);
	}

	/**
	 * Generates an array which is required for a redirect
	 *
	 * @param string $url
	 * @param array $params
	 * @return array
	 */
	public function generateRedirect($url, array $params = array()){
		return $this->renderer('redirect', \array_merge($params, array('url' => $url)), null);
	}

	/**
	 * An internal function which generates an array for the rendering of the view
	 *
	 * @param string $method
	 * @param array $params
	 * @param null|string $template
	 * @return array
	 */
	private function renderer($method, array $params, $template){
		$renderInformations = array('_method' => $method);

		if($template != null){
			$renderInformations['_template'] = $template;
		}

		return \array_merge($params, $renderInformations);
	}

}
