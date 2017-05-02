<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('news_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->string('subtitle');

			$table->longtext('body')->nullable();

			$table->tinyinteger('is_active')->default(0)->index();

			$table->string('locale')->index();

			$table->unique(['news_id','locale']);

    		$table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news_translations');
	}

}
