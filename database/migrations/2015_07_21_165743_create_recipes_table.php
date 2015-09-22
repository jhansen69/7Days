<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mods', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->decimal('alpha')->default(12.4);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        //
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('count')->default(1);
            $table->integer('craft_time')->default(5);
            $table->integer('craft_xp')->default(2);
            $table->integer('learn_xp')->default(20);
            $table->string('name');
            $table->string('craft_area')->nullable()->default('');
            $table->string('craft_tool')->nullable()->default('');
            $table->smallInteger('scrapable')->default(0);

            $table->smallInteger('core')->default(0);
            $table->decimal('alpha')->default(12.4);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('mod_id')->unsigned();
            $table->foreign('mod_id')->references('id')->on('mods');

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
        //
        Schema::drop('recipes');
        Schema::drop('mods');
    }
}
