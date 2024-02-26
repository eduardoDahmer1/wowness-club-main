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
    public function up()
    {
        Schema::create('ignore_occurrences', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('calendar_id');
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
            $table->foreignUuid('service_id')->constrained();
            $table->string('title')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
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
        Schema::dropIfExists('ignore_occurrences');
    }
};
