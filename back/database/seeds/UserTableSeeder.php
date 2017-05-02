<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\User;

class UserTableSeeder extends Seeder {

	/**
	 *
	 * @return void
	 */
	public function run()
	{
		User::first() ?: User::create([
			'email' => 'admin@test.com',
			'password' => '123456',
			'first_name' => 'ideil',
			'last_name' => 'admin',
		]);

		User::first() ?: User::create([
			'email' => 'demo@ideil.com',
			'password' => 'demo',
			'first_name' => 'demo',
			'last_name' => 'demo',
		]);
	}

}
