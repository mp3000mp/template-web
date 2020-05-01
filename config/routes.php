<?php

/**
 * define routes here
 */
	
$routes = [
	'public' => [],
	'private' => [],
];

// 'name' => ['method', 'route', 'target']
$routes['public'] = [
	'lang' => ['GET', '/lang/[a:lang]/select', 'AppController#lang'],
	'home' => ['GET', '/', 'AppController#home'],
	'test' => ['GET', '/test', 'AppController#test'],
	'test.test' => ['GET', '/test/test', 'AppController#testTest'],
];

$routes['private'] = [

];

$routes['json_public'] = [

];

$routes['json_private'] = [

];

return $routes;
