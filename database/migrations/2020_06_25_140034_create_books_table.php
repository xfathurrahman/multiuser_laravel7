<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')
            ->onDelete('cascade')->default('0');
            $table->foreignId('client_id')->constrained('clients')
            ->onDelete('cascade')->default('0');
            $table->foreignId('user_id')->constrained('users')
            ->onDelete('cascade')->default('0');
            $table->string('book_name', '50');
            $table->string('isbn_number', '14');
            $table->date('received_date');
            $table->date('delivery_date');
            $table->string('author_first_name', '50');
            $table->string('author_last_name', '50');
            $table->softDeletes();
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
        Schema::dropIfExists('books');
    }
}
