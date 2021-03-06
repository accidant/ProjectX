<?php
namespace Core\CoreBaseBundle\Controller;

use Core\CoreBaseBundle\Component\Controller\AbstractInformationService;
use Core\CoreBaseBundle\Component\Controller\InformationService;
use Core\CoreBaseBundle\Component\Controller\ResponseService;
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
	 * @var \Core\CoreBaseBundle\Component\Controller\ResponseService
	 */
	protected $responseService;

	/**
	 * @todo Dokumentieren
	 * @param \Core\CoreBaseBundle\Component\Controller\ResponseService $service
	 */
	public function setResponseService(ResponseService $service){
		$this->responseService = $service;
	}

	/**
	 * @todo Dokumentieren
	 * @return \Core\CoreBaseBundle\Component\Controller\ResponseService
	 */
	public function getResponseService(){
		return $this->responseService;
	}

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
	public function findOneBy(array $elements, $repository = '') {
		$repository = $this->getRepositoryName($repository);

		$entity = $this->getDoctrine()->getRepository($repository)->findOneBy($elements);
		$this->throwExceptionIfNull($entity);

		return $entity;
	}

	private function getRepositoryName($repository) {
		if($repository == ''){
			$repository = $this->getInformationService()->getFullControllerName();
			$strpos = \strrpos($repository, "Backend");

			if (false !== $strpos){
				$repository = \substr($repository, 0, $strpos);
			}

			return $repository;
		}

		return $repository;
	}
        
     /**
	 * Checks if entity with given dependencies exists
	 *
	 * @param array $elements
	 * @param string $repository
	 * @return boolean
	 */
	public function exists(array $elements, $repository = ''){
		$repository = $this->getRepositoryName($repository);

		$entities = $this->getDoctrine()->getRepository($repository)->findBy($elements);

		return $entities!=null;
	}
        
	/**
	 * Persists the given entity
	 *
	 * @param object $entity
	 */        
	public function persistEntity($entity) {
		$em = $this->getDoctrine()->getEntityManager();

                try {
                    $em->persist($entity);
                    $em->flush();
                } catch (\PDOException $e) {
                    $this->get('session')->setFlash('error', 'Entity could not be deleted. Perhaps the name is not unique.');
                }
	}

     /**
	 * Removes the given entity
	 *
	 * @param object $entity
	 */
        public function removeEntity($entity) {
            $em = $this->getDoctrine()->getEntityManager();

            $em->remove($entity);
            $em->flush();
        }

	/**
	 * Throws an Exception if the delivered entity is NULL
	 *
	 * @param BaseEntity $entity
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	protected function throwExceptionIfNull($entity){
		if ($entity == null) {
                    throw $this->createNotFoundException('Unable to find entity.');
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
		return $this->responseService->renderer('render', $params, $template);
	}

	/**
	 * Generates an array which is required for a redirect
	 *
	 * @param string $url
	 * @param array $params
	 * @return array
	 */
	public function generateRedirect($url, array $params = array()){
		return $this->responseService->renderer('redirect', \array_merge($params, array('url' => $url)), null);
	}
}
