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
            $table->id('unit_ID');
            $table->string('unitName', 40);
            $table->string('unitCode', 8);
            $table->timestamps();
        });
    
        $data = [
            ['unit_ID' => 1, 'unitName'=> 'Kilometres', 'UnitCode'=> 'km'],
            ['unit_ID' => 2, 'unitName'=> 'Kilometres per hour', 'UnitCode'=> 'kph'],
            ['unit_ID' => 3, 'unitName'=> 'Max Kilometres per hour', 'UnitCode'=> 'kph'],
            ['unit_ID' => 4, 'unitName'=> 'Average kilometres per hour', 'UnitCode'=> 'kph'],
            ['unit_ID' => 5, 'unitName'=> 'Heartbeats per minute', 'UnitCode'=> 'bpm'],
            ['unit_ID' => 6, 'unitName'=> 'Average Heartbeats per minute', 'UnitCode'=> 'bpm'],
            ['unit_ID' => 7, 'unitName'=> 'Elevation gain', 'UnitCode'=> 'm'],
            ['unit_ID' => 8, 'unitName'=> 'Calories', 'UnitCode'=> 'cal'],
            ['unit_ID' => 9, 'unitName'=> 'Minutes', 'UnitCode'=> 'min'],
            ['unit_ID' => 10, 'unitName'=> 'Times', 'UnitCode'=> 'times'],

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
