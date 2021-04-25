<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_ID');
            $table->string('email', 70)->unique();
            $table->string('username', 30)->unique();
            $table->string('password', 180);
            $table->foreignId('gender_ID')->default('3');
            $table->string('firstName', 30)->nullable();
            $table->string('lastName', 30)->nullable();
            $table->date('birthDate')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
