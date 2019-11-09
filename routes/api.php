<?php

/**
 * @var \Laravel\Lumen\Routing\Router $router
 * */

$router->get('login', 'AuthController@login');

$router->group([
	'middleware' => 'auth:api',
], function() use ($router) {

});

$router->get('{query:[A-Za-z\/\-]*}', function() {
	abort(404);
});