<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCcTable extends Migration
{
    /**
     * Run the migrations.
     * участники текущего соревнования
     * @return void
     */
    public function up()
    {
        Schema::create('competitor_competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competition_id');
            $table->integer('competitor_id');
            $table->integer('weight');
            $table->boolean('is_current')->default(0);//выступает сейчас
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitor_competitions');
    }
}
