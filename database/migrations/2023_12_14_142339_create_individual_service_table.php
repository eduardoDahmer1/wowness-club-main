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
        Schema::create('individual_service', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('service_id')->constrained()->cascadeOnDelete();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->string('occurrence_type')->nullable();
            $table->string('weekday')->nullable();
            $table->string('when')->nullable();
            $table->unsignedInteger('schedule_time')->nullable();
            $table->unsignedInteger('schedule_type')->nullable();
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
        Schema::dropIfExists('individual_service');
    }
};
