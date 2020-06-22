<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZulrahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zulrahs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('obtained')->default(0)->unsigned();
            $table->integer('kill_count')->default(0)->unsigned();
            $table->integer('magic_fang')->default(0)->unsigned();
            $table->integer('uncut_onyx')->default(0)->unsigned();
            $table->integer('tanzanite_mutagen')->default(0)->unsigned();
            $table->integer('pet_snakeling')->default(0)->unsigned();
            $table->integer('jar_of_swamp')->default(0)->unsigned();
            $table->integer('tanzanite_fang')->default(0)->unsigned();
            $table->integer('zul-andra_teleport')->default(0)->unsigned();
            $table->integer('magma_mutagen')->default(0)->unsigned();
            $table->integer('serpentine_visage')->default(0)->unsigned();
            $table->integer('zulrahs_scales')->default(0)->unsigned();
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
        Schema::dropIfExists('zulrahs');
    }
}
