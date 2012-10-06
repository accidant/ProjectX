<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('events', new Route('/', array(
    '_controller' => 'ModuleEventBundle:Event:index',
)));

$collection->add('events_show', new Route('/{id}/show', array(
    '_controller' => 'ModuleEventBundle:Event:show',
)));

$collection->add('events_new', new Route('/new', array(
    '_controller' => 'ModuleEventBundle:Event:new',
)));

$collection->add('events_create', new Route(
    '/create',
    array('_controller' => 'ModuleEventBundle:Event:create'),
    array('_method' => 'post')
));

$collection->add('events_edit', new Route('/{id}/edit', array(
    '_controller' => 'ModuleEventBundle:Event:edit',
)));

$collection->add('events_update', new Route(
    '/{id}/update',
    array('_controller' => 'ModuleEventBundle:Event:update'),
    array('_method' => 'post')
));

$collection->add('events_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'ModuleEventBundle:Event:delete'),
    array('_method' => 'post')
));

return $collection;
