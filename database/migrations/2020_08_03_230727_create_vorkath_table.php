<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVorkathTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vorkath', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->unsigned()->unique();
            $table->integer('kill_count')->default(0)->unsigned();
            $table->integer('rank')->default(0)->unsigned();
            $table->integer('obtained')->default(0)->unsigned();
            $table->integer('vorki')->default(0)->unsigned();
            $table->integer('vorkaths_head')->default(0)->unsigned();
            $table->integer('draconic_visage')->default(0)->unsigned();
            $table->integer('skeletal_visage')->default(0)->unsigned();
            $table->integer('jar_of_decay')->default(0)->unsigned();
            $table->integer('dragonbone_necklace')->default(0)->unsigned();
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
        Schema::dropIfExists('vorkath');
    }
}
