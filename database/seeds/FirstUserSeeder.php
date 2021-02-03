<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FirstUserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::truncate();

		User::create([
			'first_name'        => 'Администратор',
			'last_name'         => '',
			'has_access'        => true,
			'deactivated'       => NULL,
			'is_closed'         => false,
			'can_access_closed' => true,
			'email'             => 'test@mail.la',
			'password'          => '000000',
		]);
	}
}
