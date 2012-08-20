<?php

namespace Core\EntranceBundle\Controller;

use Core\EntranceBundle\Component\Controller\CmsControllerContainer;


/**
 * Date: 20.08.12
 * Time: 09:09
 * @author Thomas Joußen
 * @email tjoussen@databay.de
 * @company www.databay.de
 */
class EntranceController extends CmsControllerContainer{

	public function handleRequestAction(){

		var_dump("hallo");
		exit;
	}
}
