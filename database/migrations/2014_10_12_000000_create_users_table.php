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
            $table->id();
            $table->string('name',200);
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',200);
            $table->bigInteger('phone')->default(0);
            $table->string('profile_image',200)->nullable();
            $table->string('father',200)->nullable();
            $table->string('mother',200)->nullable();
            $table->string('wife',200)->nullable();
            $table->string('child',200)->nullable();
            $table->text('address')->nullable();
            $table->string('country',200)->default(0);
            $table->integer('city')->default(0);
            $table->integer('state')->default(0);
            $table->integer('zipcode')->default(0);
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
