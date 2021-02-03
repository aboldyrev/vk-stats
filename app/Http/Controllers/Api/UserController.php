<?php

namespace App\Http\Controllers\Api;


use App\Models\User;

class UserController
{
	public function show(User $user) {
		return $user;
	}
}