<?php

namespace Core\CoreBaseBundle\Component\Controller;

/**
 * Date: 18.10.12
 * Time: 09:29
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class ResponseService {

	/**
	 * Das Array, welches die Response für eine Erfolgreiche Aktion beinhaltet
	 *
	 * @var array
	 */
	private $successResponse = array();

	/**
	 * Das Array, welches die Repsonde für eine Fehlgeschlagene Aktion beinhaltet
	 *
	 * @var array
	 */
	private $errorResponse = array();

	/**
	 * An internal function which generates an array for the rendering of the view
	 *
	 * @param string $method
	 * @param array $params
	 * @param null|string $template
	 * @return array
	 */
	public function renderer($method, array $params, $template){
		$renderInformations = array('_method' => $method);

		if($template != null){
			$renderInformations['_template'] = $template;
		}

		return \array_merge($params, $renderInformations);
	}
}
