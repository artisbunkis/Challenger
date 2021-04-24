<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('User_ID');
            $table->string('Email', 70)->unique();
            $table->string('Username', 30)->unique();
            $table->string('Password', 40);
            $table->foreignId('Gender_ID');
            $table->string('FirstName', 30);
            $table->string('LastName', 30);
            $table->date('BirthDate');
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
        Schema::dropIfExists('user');
    }
}
