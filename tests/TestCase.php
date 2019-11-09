<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;

/**
 * Class TestCase
 *
 * @property array $header
 */
abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
	/**
	 * Creates the application.
	 *
	 * @return \Laravel\Lumen\Application
	 */
	public function createApplication() {
		return require __DIR__ . '/../bootstrap/app.php';
	}


	protected function setUp():void {
		parent::setUp();

		Artisan::call('migrate');
		Artisan::call('passport:install');
		Artisan::call('db:seed');

		Passport::tokensCan(Permission::pluck('id', 'name')->toArray());

		/** @var User $user */
		$user = User::find(1);

		$permissions = $user->permissions()->get();
		$array_permissions = $permissions->pluck('name')->toArray();

		$token = $user
			->createToken('token', $array_permissions)
			->accessToken;

		$this->header = [ 'HTTP_AUTHORIZATION' => 'Bearer ' . $token ];
	}
}
