<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTeamsPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_teams_permissions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('users_team_id')->nullable();

			$table->string('permission');

			$table->tinyinteger('value')->default(0)->unsigned();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_teams_permissions');
	}

}
