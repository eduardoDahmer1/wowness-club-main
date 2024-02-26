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
        Schema::table('users', function (Blueprint $table) {
            $table->string('offer')->nullable();
            $table->string('help')->nullable();
            $table->string('site')->nullable();
            $table->string('years_experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('offer');
            $table->dropColumn('help');
            $table->dropColumn('site');
            $table->dropColumn('years_experience');
        });
    }
};
