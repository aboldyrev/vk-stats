<?php

/**
 * @var \Laravel\Lumen\Routing\Router $router
 * */

$router->get('login', 'AuthController@login');

$router->group([
	'middleware' => 'auth:api',
], function(\Laravel\Lumen\Routing\Router $router) {

	$router->group([
		'prefix'    => 'vk',
		'namespace' => 'Vk'
	], function(\Laravel\Lumen\Routing\Router $router) {

		$router->get('search', 'UserController@search');

	});

});

$router->get('{query:[A-Za-z\/\-]*}', function() {
	abort(404);
});