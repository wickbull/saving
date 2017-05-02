<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('page_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->longtext('body')->nullable();

			$table->tinyinteger('is_active')->default(1)->unsigned()->index();

			$table->string('locale')->index();

			$table->unique(['page_id','locale']);
   			
   			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages_translations');
	}

}

