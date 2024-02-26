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
        Schema::create('schedulings', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('service_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('not_schedule');
            $table->unsignedInteger('not_schedule_type');
            $table->unsignedInteger('max_events');
            $table->unsignedInteger('when');
            $table->unsignedInteger('when_time');
            $table->unsignedInteger('when_type');
            $table->unsignedInteger('schedule_time')->nullable();
            $table->unsignedInteger('schedule_type')->nullable();
            $table->dateTime('schedule_start')->nullable();
            $table->dateTime('schedule_end')->nullable();
            $table->unsignedInteger('indefinitely')->nullable();
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
        Schema::dropIfExists('schedulings');
    }
};
