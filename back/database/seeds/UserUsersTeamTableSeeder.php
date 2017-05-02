<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\UserUsersTeam;

class UserUsersTeamTableSeeder extends Seeder {

	/**
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		UserUsersTeam::create([
			'user_id' => '1',
			'users_team_id' => '1',
		]);

	}

}
