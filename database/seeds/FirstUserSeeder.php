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
			'name'     => 'admin',
			'email'    => 'test@mail.loc',
			'password' => 000000,
		]);
	}
}
