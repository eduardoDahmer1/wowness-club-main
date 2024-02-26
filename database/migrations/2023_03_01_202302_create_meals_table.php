<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $this->insertMeals();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }

    private function insertMeals(): void
    {
        DB::table('meals')->insert([
            0 =>
            [
                'id' => 1,
                'name' => 'Vegan',
            ],
            1 =>
            [
                'id' => 2,
                'name' => 'Vegetarian',
            ],
            2 =>
            [
                'id' => 3,
                'name' => 'Pescetarian',
            ],
            3 =>
            [
                'id' => 4,
                'name' => 'Organic',
            ],
            4 =>
            [
                'id' => 5,
                'name' => 'Gluten-Free',
            ],
            5 =>
            [
                'id' => 6,
                'name' => 'Dairy-Free',
            ],
            6 =>
            [
                'id' => 7,
                'name' => 'Nut-Free',
            ],
            7 =>
            [
                'id' => 8,
                'name' => 'Includes Meat',
            ],
            8 =>
            [
                'id' => 9,
                'name' => 'Ayuverdic',
            ],
        ]);
    }
};
