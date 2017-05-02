<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericFileAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generic_file_attachments', function(Blueprint $table)
		{
			// unique key
			// ModelClass:id:field_name
			$table->string('key')->primary();

			// generic file
			$table->integer('generic_file_id');

			// crop value
			// \d+x\d+-\d+x\d+
			$table->string('crop');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('generic_file_attachments');
	}

}
