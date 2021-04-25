<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gender', function (Blueprint $table) {
            $table->id('Gender_ID');
            $table->string('GenderName', 7);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('gender')->insert(
            array(
                'Gender_ID' => 1,
                'GenderName' => 'Male'
            )
        );
        DB::table('gender')->insert(
            array(
                'Gender_ID' => 2,
                'GenderName' => 'Female'
            )
        );

    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gender');
    }
}
