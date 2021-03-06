<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Helpers\Helper;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (Helper::listSkills() as $skill) {
            Schema::create($skill, function (Blueprint $table) {
                $table->id();
                $table->integer('account_id')->unsigned()->unique();
                $table->integer('rank')->default(0);
                $table->integer('level')->default(1);
                $table->bigInteger('xp')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
    }
}
