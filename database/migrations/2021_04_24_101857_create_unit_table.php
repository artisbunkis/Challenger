<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit', function (Blueprint $table) {
            $table->id('Unit_ID');
            $table->string('UnitName', 40);
            $table->string('UnitCode', 8);
            $table->timestamps();
        });
    
        $data = [
            ['Unit_ID' => 1, 'UnitName'=> 'Kilometres', 'UnitCode'=> 'km'],
            ['Unit_ID' => 2, 'UnitName'=> 'Kilometres per hour', 'UnitCode'=> 'kph'],
            ['Unit_ID' => 3, 'UnitName'=> 'Max Kilometres per hour', 'UnitCode'=> 'kph'],
            ['Unit_ID' => 4, 'UnitName'=> 'Average kilometres per hour', 'UnitCode'=> 'kph'],
            ['Unit_ID' => 5, 'UnitName'=> 'Heartbeats per minute', 'UnitCode'=> 'bpm'],
            ['Unit_ID' => 6, 'UnitName'=> 'Average Heartbeats per minute', 'UnitCode'=> 'bpm'],
            ['Unit_ID' => 7, 'UnitName'=> 'Elevation gain', 'UnitCode'=> 'm'],
            ['Unit_ID' => 8, 'UnitName'=> 'Calories', 'UnitCode'=> 'cal'],
            ['Unit_ID' => 9, 'UnitName'=> 'Minutes', 'UnitCode'=> 'min'],
            ['Unit_ID' => 10, 'UnitName'=> 'Times', 'UnitCode'=> 'times'],

            //...
        ];

        DB::table('unit')->insert($data);
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit');
    }
}
