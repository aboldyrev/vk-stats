<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class FirstUserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::truncate();

		/** @var User $user */
		$user = User::create([
			'name'      => 'admin',
			'email'     => 'test@mail.loc',
			'password'  => '000000',
			'is_active' => 1
		]);

		$user->permissions()->attach(Permission::all()->pluck('id')->toArray());
	}
}
