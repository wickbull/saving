<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_categories_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('news_category_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->tinyinteger('is_active')->default(0);

			$table->tinyinteger('is_top')->default(0);

			$table->string('locale')->index();

			$table->unique(['news_category_id','locale'], 'news_categories_translations_index_unique');

    		$table->foreign('news_category_id', 'news_categories_translations_foreign')->references('id')->on('news_categories')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news_categories_translations');
	}

}
