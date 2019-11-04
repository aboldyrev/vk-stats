<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

class RootController extends Controller
{
	public function index() {
		$message = 'See API documentation';

		return compact('message');
	}
}