<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUsersTeamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_users_team', function(Blueprint $table)
		{
			$table->primary(['user_id', 'users_team_id'], 'primary_key');

			$table->integer('user_id');

			$table->integer('users_team_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_users_team');
	}

}
