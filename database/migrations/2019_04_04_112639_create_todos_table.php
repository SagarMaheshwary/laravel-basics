<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {

            /**
             * Unsigned big integer equivalent column with
             * auto_increment and primary key.
             */
            $table->bigIncrements('id');

            /**
             * Varchar equivalent column and you
             * can pass the length as a second parameter.
             */
            $table->string('title')->unique();

            /**
             * Text equivalent column.
             */
            $table->text('body');

            /**
             * This will create created_at and updated_at
             * timestamp columns that are automatically filled
             * by Laravel.
             */
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
        Schema::dropIfExists('todos');
    }
}
