<?php

namespace System\PageBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;
/**
 * Date: 27.08.12
 * Time: 14:39
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PageController extends AbstractModuleController{

	public function indexAction(){
		return 'SystemPageBundle:Page:index.html.twig';
	}
}
