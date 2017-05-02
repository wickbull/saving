<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriorityFieldInChairsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chairs', function (Blueprint $table) {
            $table->integer('priority')->unsigned()->after('id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chairs', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }

}
