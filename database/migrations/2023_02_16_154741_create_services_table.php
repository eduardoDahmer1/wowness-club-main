<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /* 
    TODO: implementar categorias

    • Categories ou subcategories (Só vai estar associado a uma categoria se essa categoria não tiver uma subcategoria) (RN2)
    */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            /* ENUM */
            $table->unsignedInteger('method');
            $table->unsignedInteger('type');
            $table->unsignedInteger('target');
            $table->unsignedInteger('modality');

            /* Required */
            $table->unsignedInteger('uses');
            $table->unsignedInteger('group_size');
            $table->string('name');
            $table->string('city')->nullable();
            $table->string('disclaimer')->nullable();
            $table->string('photo');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignUuid('user_id')->constrained();



            /* Text */
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('highlights')->nullable();
            $table->text('benefits')->nullable();
            $table->text('transport')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('state')->nullable();
            $table->text('included')->nullable();
            $table->text('not_included')->nullable();
            $table->text('directions')->nullable();
            $table->text('next_steps')->nullable();
            $table->text('schedule')->nullable();
            $table->integer('number')->nullable();

            $table->string('complement')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
