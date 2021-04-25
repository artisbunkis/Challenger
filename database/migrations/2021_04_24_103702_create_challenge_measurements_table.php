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
            $table->id('challengeMeasurement_ID');
            $table->foreignId('challenge_ID')->constrained();
            $table->foreignId('unit_ID')->constrained();
            $table->double('goalValue');
            $table->foreignId('comparison_ID');
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
