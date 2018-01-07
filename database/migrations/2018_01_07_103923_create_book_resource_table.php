<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->string('name');
            $table->string('quantity');
            $table->string('genre');
            $table->string('price');
            $table->string('is_deleted')->default(0);
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
        Schema::dropIfExists('book_resources');
    }
}
