<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMaterialFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chairs', function ($table) {
			$table->integer('creator_id')->after('id')->unsigned();
			$table->integer('editor_id')->after('id')->unsigned();
		});
		Schema::table('subjects', function ($table) {
			$table->integer('creator_id')->after('id')->unsigned();
			$table->integer('editor_id')->after('id')->unsigned();
		});
		Schema::table('laboratories', function ($table) {
			$table->integer('creator_id')->after('id')->unsigned();
			$table->integer('editor_id')->after('id')->unsigned();
		});
		Schema::table('lecturers', function ($table) {
			$table->integer('creator_id')->after('is_dean')->unsigned();
			$table->integer('editor_id')->after('is_dean')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
