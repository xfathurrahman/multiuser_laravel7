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
            $table->string('first_name')->comment('First name');    
            $table->string('middle_name')->comment('Middle name');
            $table->string('last_name')->comment('Last name');
            $table->string('client_id')->comment('Client name get from Client table');
            $table->datetime('dob')->comment('Date Of Birth');
            $table->string('address', '200')->comment('Address');
            $table->integer('state_id')->comment('State');
            $table->integer('country_id')->comment('Country');
            $table->string('pincode', '10')->comment('Pincode');

            $table->string('name')->unique()->comment('already register Username not allowed');
            $table->string('email')->unique()->comment('already register email ID not allowed');
            $table->integer('role')->default('3')->comment('User Role id allotted based on role table');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('ip_address', '50')->nullable();
            $table->string('password');
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
