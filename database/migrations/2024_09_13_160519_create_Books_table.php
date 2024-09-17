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
            $table->string('content')->nullable();
            $table->string('visuals')->nullable();
            $table->string('book_cover')->nullable();
            $table->string('layout_formating')->nullable();
            $table->string('genres')->nullable();
            $table->string('physical_attributes')->nullable();
            $table->string('interactive_elements')->nullable();
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
        Schema::dropIfExists('book');
    }
}
