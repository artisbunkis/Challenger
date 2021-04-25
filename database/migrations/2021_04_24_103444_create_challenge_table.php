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
            $table->id('Challenge_ID');
            $table->foreignId('SportsType_ID');
            $table->foreignId('CreatorUser_ID');
            $table->string('ChallengeName', 50);
            $table->dateTime('BeginDate');
            $table->dateTime('EndDate');
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
