<?php

namespace App\Http\Middleware;

use Closure;

class Headers
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$response = $next($request);
		$response->header('X-Content-Type-Options', 'nosniff');
		$response->header('Access-Control-Allow-Origin', '*');
		$response->header('Access-Control-Allow-Credentials', 'true');
		$response->header('Access-Control-Allow-Headers', 'Access-Control-Request-Headers, Access-Control-Request-Method, Accept, Access-Control-Allow-Headers, origin, x-requested-with, content-type');
		$response->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS, HEAD');

		return $response;
	}
}