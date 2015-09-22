<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->timestamps();
            $table->integer('pimp_id')->unsigned();
            $table->string('name')->unique();

            $table->smallInteger('core')->default(0);
            $table->decimal('alpha')->default(12.4);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('mod_id')->unsigned();
            $table->foreign('mod_id')->references('id')->on('mods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
