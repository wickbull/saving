<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('email')->unique();

			$table->string('password', 60);

			$table->string('first_name')->index();

			$table->string('last_name')->index();

			$table->string('nickname')->unique()->nullable();

			$table->longtext('descr')->nullable();

			$table->integer('photo_storage_id')->nullable();

			$table->rememberToken();

			$table->softDeletes();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
