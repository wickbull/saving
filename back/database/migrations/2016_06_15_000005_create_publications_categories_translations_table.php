<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsCategoriesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications_categories_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('publications_category_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->tinyinteger('is_active')->default(0);

			$table->tinyinteger('is_top')->default(0);

			$table->string('locale')->index();

			$table->unique(['publications_category_id','locale'], 'publications_categories_translations_index_unique');

    		$table->foreign('publications_category_id', 'publications_categories_translations_foreign')->references('id')->on('publications_categories')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publications_categories_translations');
	}

}
