<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('image_storage_id')->nullable();

			$table->integer('creator_id')->unsigned();

			$table->integer('editor_id')->unsigned();

			$table->tinyinteger('is_top')->default(0)->index();

			$table->timestamp('publish_at')->nullable()->default(null);

			$table->timestamps();

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
		Schema::drop('news');
	}

}
