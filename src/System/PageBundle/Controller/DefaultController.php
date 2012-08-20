<?php

namespace System\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('SystemPageBundle:Default:index.html.twig', array('name' => $name));
    }
}
