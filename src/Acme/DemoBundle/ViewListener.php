<?php

namespace Acme\DemoBundle;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Acme\DemoBundle\Twig\Extension\DemoExtension;

class ViewListener
{

    public function __construct()
    {
		var_dump("hallo");
    }
	
	public function onKernelView(FilterResponseEvent $event)
    {
		$val = $event->getResponse();
		var_dump($val);
		exit;
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
        }
    }
}
