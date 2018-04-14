<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKataCc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
				Schema::table('competitor_competitions', function (Blueprint $table) {
						$table->integer('kate_id')->nullable();
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
				Schema::table('competitor_competitions', function (Blueprint $table) {
						$table->dropColumn('kate_id');
				});
    }
}
