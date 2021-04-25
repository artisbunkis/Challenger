<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSportsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports_type', function (Blueprint $table) {
            $table->id('sportsType_ID');
            $table->foreignId('unit_ID');
            $table->string('sportsTypeName', 30);
            $table->timestamps();
        });

        $data = [
            ['sportsType_ID' => 1, 'unit_ID'=> 1, 'sportsTypeName'=> 'Running'],
            ['sportsType_ID' => 2, 'unit_ID'=> 1, 'sportsTypeName'=> 'Road Cycling'],
            ['sportsType_ID' => 3, 'unit_ID'=> 1, 'sportsTypeName'=> 'Mountain Biking'],
            ['sportsType_ID' => 4, 'unit_ID'=> 1, 'sportsTypeName'=> 'Walking'],
            ['sportsType_ID' => 5, 'unit_ID'=> 1, 'sportsTypeName'=> 'Orienteering'],
            ['sportsType_ID' => 6, 'unit_ID'=> 9, 'sportsTypeName'=> 'Basketball'],
            ['sportsType_ID' => 7, 'unit_ID'=> 9, 'sportsTypeName'=> 'Soccer'],
            ['sportsType_ID' => 8, 'unit_ID'=> 9, 'sportsTypeName'=> 'Hockey'],
            ['sportsType_ID' => 9, 'unit_ID'=> 9, 'sportsTypeName'=> 'Tennis'],
            ['sportsType_ID' => 10, 'unit_ID'=> 1, 'sportsTypeName'=> 'Swimming'],
            ['sportsType_ID' => 11, 'unit_ID'=> 9, 'sportsTypeName'=> 'Gymnastics'],
            ['sportsType_ID' => 12, 'unit_ID'=> 9, 'sportsTypeName'=> 'Weight Lifting'],
            //...
        ];

        DB::table('sports_type')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sports_type');
    }
}
