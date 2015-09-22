<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('damage_category')->default('');
            $table->string('surface_category')->default('');
            $table->string('particle_category')->default('');
            $table->string('destroy_category')->default('');
            $table->string('forge_category')->default('');
            $table->string('hardness')->default('');
            $table->string('stepsound')->default('');
            $table->string('lightopacity')->default('0');
            $table->string('stability_glue')->default('');
            $table->string('mass')->default('');
            $table->smallInteger('plant')->default(0);
            $table->smallInteger('stability_support')->default(0);
            $table->smallInteger('collidable')->default(0);
            $table->smallInteger('ground_cover')->default(0);
            $table->string('movement_factor')->default('');
            $table->string('explosion_resistance')->default('');

            $table->smallInteger('core')->default(0);
            $table->decimal('alpha')->default(12.4);
            $table->integer('mod_id')->unsigned();
            $table->foreign('mod_id')->references('id')->on('mods');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materials');
    }
}
