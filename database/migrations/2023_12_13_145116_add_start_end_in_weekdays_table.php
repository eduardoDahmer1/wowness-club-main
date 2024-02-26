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
        Schema::table('weekdays', function (Blueprint $table) {
            $table->time('start')->nullable();
            $table->time('end')->nullable();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('occurrence_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekdays', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('occurrence_type');
        });
    }
};
