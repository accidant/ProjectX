<?php

namespace Core\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
/**
 * Date: 20.08.12
 * Time: 14:31
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class SecurityController extends Controller{

	public function loginAction(){
		$request = $this->getRequest();
		$session = $request->getSession();

		// get the login error if there is one
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render('CoreSecurityBundle:Security:login.html.twig', array(
			// last username entered by the user
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error'         => $error,
		));
	}

	public function testAction(){
		return array('test');
	}
}
