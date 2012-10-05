<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('games', new Route('/', array(
    '_controller' => 'ModuleGameBundle:Game:index',
)));

$collection->add('games_show', new Route('/{id}/show', array(
    '_controller' => 'ModuleGameBundle:Game:show',
)));

$collection->add('games_new', new Route('/new', array(
    '_controller' => 'ModuleGameBundle:Game:new',
)));

$collection->add('games_create', new Route(
    '/create',
    array('_controller' => 'ModuleGameBundle:Game:create'),
    array('_method' => 'post')
));

$collection->add('games_edit', new Route('/{id}/edit', array(
    '_controller' => 'ModuleGameBundle:Game:edit',
)));

$collection->add('games_update', new Route(
    '/{id}/update',
    array('_controller' => 'ModuleGameBundle:Game:update'),
    array('_method' => 'post')
));

$collection->add('games_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'ModuleGameBundle:Game:delete'),
    array('_method' => 'post')
));

return $collection;
