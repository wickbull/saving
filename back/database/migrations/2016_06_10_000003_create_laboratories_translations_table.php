<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoriesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laboratories_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('laboratory_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->longtext('body')->nullable();

			$table->tinyinteger('is_active')->default(0)->index();

			$table->string('locale')->index();

			$table->unique(['laboratory_id','locale']);

    		$table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laboratories_translations');
	}

}
