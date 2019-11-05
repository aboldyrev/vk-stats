<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Boot the authentication services for the application.
	 *
	 * @return void
	 */
	public function boot() {
		if(Schema::hasTable('permissions')) {
			Passport::tokensCan(Permission::pluck('id', 'name')->toArray());
		}

		$this->app[ 'auth' ]->viaRequest('api', function($request) {
			if ($request->input('api_token')) {
				return User::where('api_token', $request->input('api_token'))->first();
			}
		});
	}
}
