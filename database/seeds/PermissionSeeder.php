<?php

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends \Illuminate\Database\Seeder
{
	public function run() {
		foreach (Permission::all() as $permission) {
			$permission->delete();
		}

		/** Все доступные возможности */
		$permissions = [ 'edit', 'view' ];

		/** Добавление возможностей */
		foreach ($permissions as $permission) {
			Permission::create([
				'name'        => $permission,
				'guard_name'  => 'api'
			]);
		}
	}
}