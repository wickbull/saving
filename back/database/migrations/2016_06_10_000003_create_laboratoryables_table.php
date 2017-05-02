<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laboratoryables', function(Blueprint $table)
		{
			$table->integer('laboratory_id')->index();

			$table->integer('laboratoryable_id')->index();

			$table->string('laboratoryable_type')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laboratoryables');
	}

}
