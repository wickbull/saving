<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags_groups', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');

			$table->string('slug')->index();

			$table->tinyinteger('is_top')->default(1);

			$table->string('locale');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags_groups');
	}

}
