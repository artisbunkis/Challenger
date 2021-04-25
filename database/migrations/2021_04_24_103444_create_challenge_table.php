<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge', function (Blueprint $table) {
            $table->id('challenge_ID');
            $table->foreignId('sportsType_ID');
            $table->foreignId('creatorUser_ID');
            $table->string('challengeName', 50);
            $table->dateTime('beginDate');
            $table->dateTime('endDate');
            $table->boolean('isPublic')->default('1');
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
        Schema::dropIfExists('challenge');
    }
}
