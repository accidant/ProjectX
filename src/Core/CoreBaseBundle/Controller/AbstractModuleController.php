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
	 * @param string $repository
	 * @param array $elements
	 * @return array
	 */
	public function findBy($repository, array $elements){
		$entity = $this->getDoctrine()->getRepository($repository)->findBy($elements);
		$this->throwExceptionIfNull($entity);

		return $entity;
	}

	/**
	 * Trys to find an entity from the delivered Repository by the delivered elements
	 *
	 * @param string $repository
	 * @param array $elements
	 * @return object
	 */
	public function findOneBy($repository, array $elements){
		$entity = $this->getDoctrine()->getRepository($repository)->findOneBy($elements);
		$this->throwExceptionIfNull($entity);

		return $entity;
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
}
