<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lecturers', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('image_storage_id')->unsigned()->nullable();

			$table->string('email')->nullable();

			$table->string('telephone')->nullable();

			$table->tinyinteger('is_dean')->default(0)->index();

			$table->timestamp('birth')->nullable()->default(null);

			$table->timestamps();

			$table->softDeletes();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lecturers');
	}

}
