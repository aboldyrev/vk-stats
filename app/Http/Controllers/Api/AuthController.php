<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function login(Request $request) {
		/** @var User $user */
		$user = User::where('name', $request->getUser())->where('is_active', 1)->first();

		if (Hash::check($request->getPassword(), $user->getAuthPassword())) {
			$permissions = $user->permissions()->get();
			$array_permissions = $permissions->pluck('name')->toArray();

			$access_token = $user
				->createToken('token', $array_permissions)
				->accessToken;

			return [ "accessToken" => $access_token ];
		}

		return abort(401);
	}
}