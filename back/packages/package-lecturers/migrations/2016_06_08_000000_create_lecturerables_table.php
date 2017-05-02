<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturerablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lecturerables', function(Blueprint $table)
		{
			$table->integer('lecturer_id')->index();

			$table->integer('lecturerable_id')->index();

			$table->string('lecturerable_type')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lecturerables');
	}

}
