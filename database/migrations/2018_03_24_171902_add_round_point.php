<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoundPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
				Schema::table('points', function (Blueprint $table) {
						$table->integer('round');//раунд в котором получены очки
				});
				Schema::table('competitions', function (Blueprint $table) {
						$table->integer('round')->default(0);//текущий раунд соревнований
				});
				Schema::table('competitor_competitions', function (Blueprint $table) {
						$table->integer('disabled_round')->default(0);//выбыл в раунде
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
				Schema::table('points', function (Blueprint $table) {
						$table->dropColumn('round');
				});
				Schema::table('competitions', function (Blueprint $table) {
						$table->dropColumn('round');
				});
				Schema::table('competitor_competitions', function (Blueprint $table) {
						$table->dropColumn('disabled_round');//выбыл в раунде
				});
    }
}
