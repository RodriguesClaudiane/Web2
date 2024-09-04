<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreignId('publisher_id')->nullable()->references('id')->on('publishers')->onDelete('set null');
            $table->integer('published_year');
            $table->string('cover')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}


