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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
        });

        $this->insertResults();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }

    private function insertResults(): void
    {
        DB::table('results')->insert([
            0 =>
            [
                'id' => 1,
                'name' => 'Healing / Emotional Release',
            ],
            1 =>
            [
                'id' => 2,
                'name' => 'Mental Health',
            ],
            2 =>
            [
                'id' => 3,
                'name' => 'Health & Wellness',
            ],
            3 =>
            [
                'id' => 4,
                'name' => 'High Performance',
            ],
            4 =>
            [
                'id' => 5,
                'name' => 'Anxiety & Stress Management',
            ],
            5 =>
            [
                'id' => 6,
                'name' => 'Love & Relationships',
            ],
            6 =>
            [
                'id' => 7,
                'name' => 'Happiness & Fun',
            ],
            7 =>
            [
                'id' => 8,
                'name' => 'Human Connection',
            ],
        ]);
    }
};
