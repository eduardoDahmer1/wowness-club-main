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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->foreignUuid('user_id')->nullable();
            $table->boolean('status')->default(false);
            $table->string('photo')->nullable();
            $table->float('overall');
            $table->float('practitioner');
            $table->float('practitioner_knowledge');
            $table->float('practitioner_communication');
            $table->float('practitioner_recommend');
            $table->float('service');
            $table->float('service_quality');
            $table->float('service_value');
            $table->float('service_recommend');
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
        Schema::dropIfExists('reviews');
    }
};
