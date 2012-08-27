<?php

namespace System\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Date: 27.08.12
 * Time: 14:39
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PageController extends Controller{

	public function indexAction(){
		return 'SystemPageBundle:Page:index.html.twig';
	}
}
