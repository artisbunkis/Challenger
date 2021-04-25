<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_measurements', function (Blueprint $table) {
            $table->id('ChallengeMeasurement_ID');
            $table->foreignId('Challenge_ID')->constrained();
            $table->foreignId('Unit_ID')->constrained();
            $table->double('GoalValue');
            $table->foreignId('Comparison_ID');
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
        Schema::dropIfExists('challenge_measurements');
    }
}
