<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationPublicationsCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publication_publications_category', function(Blueprint $table)
		{
			$table->primary(['publication_id', 'publications_category_id'], 'primary_key');

			$table->integer('publication_id');

			$table->integer('publications_category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publication_publications_category');
	}

}
