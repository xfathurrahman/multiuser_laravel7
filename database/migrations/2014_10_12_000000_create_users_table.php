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
            $table->string('first_name')->nullable()->comment('First name');    
            $table->string('middle_name')->nullable()->comment('Middle name');
            $table->string('last_name')->nullable()->comment('Last name');
            $table->string('client_id')->comment('Client name get from Client table');
            $table->string('profile_image')->nullable();
            $table->string('gender', '15');
            $table->string('hobbies')->nullable();
            $table->string('address', '200')->comment('Address');
            $table->integer('country_id')->comment('Country');
            $table->integer('state_id')->comment('State');
            $table->string('city', '100')->comment('City');
            $table->string('mobile', '15')->comment('Mobile Number');

            $table->string('name', '35')->unique()->comment('already register Username not allowed');
            $table->string('email', '255')->unique()->comment('already register email ID not allowed');
            $table->integer('role')->default('3')->comment('User Role id allotted based on role table');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('ip_address', '50')->nullable();
            $table->string('password', '255');
            $table->rememberToken();
            $table->enum('status', ['0', '1'])->default('1')->comment('Active user only login');
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
