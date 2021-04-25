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
            $table->id('gender_ID');
            $table->string('genderName', 7);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('gender')->insert(
            array(
                'gender_ID' => 1,
                'genderName' => 'Male'
            )
        );
        DB::table('gender')->insert(
            array(
                'gender_ID' => 2,
                'genderName' => 'Female'
            )
        );
        DB::table('gender')->insert(
            array(
                'gender_ID' => 3,
                'genderName' => 'Unknown'
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
