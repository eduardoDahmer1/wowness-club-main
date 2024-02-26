<?php

use Illuminate\Support\Facades\DB;
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
        Schema::table('meals', function (Blueprint $table) {
            $table->string('icon')->nullable();
        });

        $this->updateMeals();
    }


    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }


    public function updateMeals(): void
    {
        DB::table('meals')
            ->where('id', 1)
            ->update(['icon' => asset('assets/images/icons-meals/vegan.png')]);

        DB::table('meals')
            ->where('id', 2)
            ->update(['icon' => asset('assets/images/icons-meals/carrot.png')]);

        DB::table('meals')
            ->where('id', 3)
            ->update(['icon' => asset('assets/images/icons-meals/fish.png')]);

        DB::table('meals')
            ->where('id', 4)
            ->update(['icon' => asset('assets/images/icons-meals/organic-food.png')]);

        DB::table('meals')
            ->where('id', 5)
            ->update(['icon' => asset('assets/images/icons-meals/gluten-free.png')]);

        DB::table('meals')
            ->where('id', 6)
            ->update(['icon' => asset('assets/images/icons-meals/lactose-free.png')]);

        DB::table('meals')
            ->where('id', 7)
            ->update(['icon' => asset('assets/images/icons-meals/peanut-free.png')]);

        DB::table('meals')
            ->where('id', 8)
            ->update(['icon' => asset('assets/images/icons-meals/meat.png')]);

        DB::table('meals')
            ->where('id', 9)
            ->update(['icon' => asset('assets/images/icons-meals/medicinal-herbs.png')]);
    }
};
