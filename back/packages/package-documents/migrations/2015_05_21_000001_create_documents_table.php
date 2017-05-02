<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('file_storage_id')->nullable()->unsigned();

			$table->integer('thumb_storage_id')->nullable()->unsigned();

			$table->timestamp('publish_at')->nullable()->default(null);

			$table->integer('year')->nullable()->default(null);

			$table->tinyinteger('is_active')->default(1)->unsigned()->index();

			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documents');
	}

}
