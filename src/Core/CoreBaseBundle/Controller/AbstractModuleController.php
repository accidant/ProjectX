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

	public function setInformationService(AbstractInformationService $service){
		$this->informationService = $service;
		$this->informationService->generate($this->container);
	}

	public function getInformationService(){
		return $this->informationService;
	}
}
