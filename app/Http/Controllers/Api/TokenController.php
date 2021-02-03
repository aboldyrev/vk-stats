<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
	public function create(Request $request) {

		$token = $request->user()->createToken($request->token_name);

		return ['token' => $token->plainTextToken];
	}
}