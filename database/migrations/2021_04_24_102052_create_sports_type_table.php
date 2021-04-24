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
            $table->id('SportsType_ID');
            $table->foreignId('Unit_ID');
            $table->string('SportsTypeName', 30);
            $table->timestamps();
        });

        $data = [
            ['SportsType_ID' => 1, 'Unit_ID'=> 1, 'SportsTypeName'=> 'Running'],
            ['SportsType_ID' => 2, 'Unit_ID'=> 1, 'SportsTypeName'=> 'Road Cycling'],
            ['SportsType_ID' => 3, 'Unit_ID'=> 1, 'SportsTypeName'=> 'Mountain Biking'],
            ['SportsType_ID' => 4, 'Unit_ID'=> 1, 'SportsTypeName'=> 'Walking'],
            ['SportsType_ID' => 5, 'Unit_ID'=> 1, 'SportsTypeName'=> 'Orienteering'],
            ['SportsType_ID' => 6, 'Unit_ID'=> 9, 'SportsTypeName'=> 'Basketball'],
            ['SportsType_ID' => 7, 'Unit_ID'=> 9, 'SportsTypeName'=> 'Soccer'],
            ['SportsType_ID' => 8, 'Unit_ID'=> 9, 'SportsTypeName'=> 'Hockey'],
            ['SportsType_ID' => 9, 'Unit_ID'=> 9, 'SportsTypeName'=> 'Tennis'],
            ['SportsType_ID' => 10, 'Unit_ID'=> 1, 'SportsTypeName'=> 'Swimming'],
            ['SportsType_ID' => 11, 'Unit_ID'=> 9, 'SportsTypeName'=> 'Gymnastics'],
            ['SportsType_ID' => 12, 'Unit_ID'=> 9, 'SportsTypeName'=> 'Weight Lifting'],
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
