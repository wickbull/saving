<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\UsersTeam;

class UsersTeamTableSeeder extends Seeder {

	/**
	 *
	 * @return void
	 */
	public function run()
	{
		UsersTeam::create([
			'title' => 'Адміністратори',
			'name' => 'administrators',
		]);

	}

}
