<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function login(Request $request) {
		/** @var \App\Models\User $user */
		$user = \App\Models\User::where('name', $request->getUser())->first();

		if (\Illuminate\Support\Facades\Hash::check($request->getPassword(), $user->getAuthPassword())) {
			$user->createToken('token');
		}
	}
}