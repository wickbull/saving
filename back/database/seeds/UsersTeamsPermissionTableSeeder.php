<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\UsersTeamsPermission;

class UsersTeamsPermissionTableSeeder extends Seeder {

	/**
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		UsersTeamsPermission::create([
			'users_team_id' => 1,
			'permission' => 'App\Http\Controllers\HomeController@getIndex',
			'value' => 1
		]);

		UsersTeamsPermission::create([
			'users_team_id' => 1,
			'permission' => 'Packages\PackageUsersTeamsPermissionsController@getTeamsList',
			'value' => 1
		]);

		UsersTeamsPermission::create([
			'users_team_id' => 1,
			'permission' => 'Packages\PackageUsersTeamsPermissionsController@getEditTeamsPermissions',
			'value' => 1
		]);

		UsersTeamsPermission::create([
			'users_team_id' => 1,
			'permission' => 'Packages\PackageUsersTeamsPermissionsController@postEditTeamsPermissions',
			'value' => 1
		]);


	}

}
