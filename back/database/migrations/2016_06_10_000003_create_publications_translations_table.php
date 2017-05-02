<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('publication_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->string('subtitle');

			$table->longtext('body')->nullable();

			$table->tinyinteger('is_active')->default(0)->index();

			$table->string('locale')->index();

			$table->unique(['publication_id','locale']);

    		$table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publications_translations');
	}

}
