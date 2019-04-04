<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColumnAndForeignConstraintToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Todo::truncate();

        Schema::table('todos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // unsigned for foreign key.

            $table->foreign('user_id') // foreign key column name.
                ->references('id') // parent table primary key.
                ->on('users') // parent table name.
                ->onDelete('cascade'); // delete all the children when the parent is deleted.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // drop the foreign key.
            $table->dropColumn('user_id'); // drop the column
        });
    }
}
