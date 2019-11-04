<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;

/**
 * Class UserModelTest
 * @see
 */
class UserModelTest extends TestCase
{
	use DatabaseMigrations;

	public function testEncodePassword() {
		/** @var User $user */
		$user = factory(User::class)->make();

		$user->password = '000000';

		$this->assertTrue(Hash::check('000000', $user->getAuthPassword()));
	}
}