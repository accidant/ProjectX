<?php

namespace Core\CoreBaseBundle\Component\Controller;

/**
 * Date: 27.08.12
 * Time: 15:13
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class InformationFactory extends AbstractInformationFactory{

	/**
	 * Findet aus dem Container die benötigten Elemente für den Request und gibt diese in einem Array zurück
	 *
	 * @param ContainerAware $container
	 *
	 * @return array
	 */
	protected function findMatchedElements($container) {
		$matches = array();
		$controller = $container->get('request')->attributes->get('_controller');
		preg_match('/(.*)\\\(.*)Bundle\\\Controller\\\(.*)Controller::(.*)Action/', $controller, $matches);
		return $matches;
	}
}
