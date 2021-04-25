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
            $table->id('comparison_ID');
            $table->string('comparisonName', 15);
            $table->char('comparisonSign', 2);
            $table->timestamps();
        });

        $data = [
            ['comparison_ID' => 1, 'comparisonName'=> 'Equals', 'comparisonSign'=> '=='],
            ['comparison_ID' => 2, 'comparisonName'=> 'Not equals', 'comparisonSign'=> '!='],
            ['comparison_ID' => 3, 'comparisonName'=> 'Less than', 'comparisonSign'=> '<'],
            ['comparison_ID' => 4, 'comparisonName'=> 'More than', 'comparisonSign'=> '>'],

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
