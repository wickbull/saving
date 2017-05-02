<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('document_id')->unsigned();

			$table->string('title');

			$table->string('locale')->index();

		    $table->unique(['document_id','locale']);
		    
		    $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documents_translations');
	}

}
