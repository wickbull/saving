<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFragmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fragments', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');

			$table->string('slug')->index();

			$table->longtext('body')->nullable();

			$table->tinyinteger('is_active')->default(1)->unsigned()->index();

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
		Schema::dropIfExists('fragments');
	}

}
