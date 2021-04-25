<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateComparisonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparison', function (Blueprint $table) {
            $table->id('Comparison_ID');
            $table->string('ComparisonName', 15);
            $table->char('ComparisonSign', 2);
            $table->timestamps();
        });

        $data = [
            ['Comparison_ID' => 1, 'ComparisonName'=> 'Equals', 'ComparisonSign'=> '=='],
            ['Comparison_ID' => 2, 'ComparisonName'=> 'Not equals', 'ComparisonSign'=> '!='],
            ['Comparison_ID' => 3, 'ComparisonName'=> 'Less than', 'ComparisonSign'=> '<'],
            ['Comparison_ID' => 4, 'ComparisonName'=> 'More than', 'ComparisonSign'=> '>'],

            //...
        ];

        DB::table('comparison')->insert($data);
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comparison');
    }
}
