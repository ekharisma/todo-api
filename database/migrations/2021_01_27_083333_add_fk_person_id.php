<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkPersonId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todo_table', function (Blueprint $table) {
            //add foreign key
            $table->integer('Person_id')->nullable();
            $table->foreign('Person_id')->references('id')->on('Person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todo_table', function (Blueprint $table) {
            //
        });
    }
}
