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
        $this->updateResults();

        DB::table('results')->insert([
            [
                'id' => 9,
                'name' => 'Balance & Relaxation',
                'icon' => asset('assets/images/icons-results/sunbathing.png')
            ],

            [
                'id' => 10,
                'name' => 'Emotional Intelligence',
                'icon' => asset('assets/images/icons-results/emotional-intelligence.png')
            ],

            [
                'id' => 11,
                'name' => 'Physical Health',
                'icon' => asset('assets/images/icons-results/muscle.png')
            ],

            [
                'id' => 12,
                'name' => 'Weight Loss',
                'icon' => asset('assets/images/icons-results/apple.png')
            ],
            [
                'id' => 13,
                'name' => 'Money Energy & Wealth',
                'icon' => asset('assets/images/icons-results/money-energy.png')
            ],
        ]);
    }


    public function updateResults(): void
    {
        DB::table('results')
            ->where('id', 3)->delete();

        DB::table('results')
            ->where('id', 1)
            ->update(['icon' => asset('assets/images/icons-results/heart.png')]);

        DB::table('results')
            ->where('id', 2)
            ->update(['icon' => asset('assets/images/icons-results/mental-health.png')]);

        DB::table('results')
            ->where('id', 4)
            ->update(['icon' => asset('assets/images/icons-results/meter.png')]);

        DB::table('results')
            ->where('id', 5)
            ->update(['icon' => asset('assets/images/icons-results/inner-beauty.png')]);

        DB::table('results')
            ->where('id', 6)
            ->update(['icon' => asset('assets/images/icons-results/talk.png')]);

        DB::table('results')
            ->where('id', 7)
            ->update(['icon' => asset('assets/images/icons-results/laugh.png')]);

        DB::table('results')
            ->where('id', 8)
            ->update(['icon' => asset('assets/images/icons-results/business-people.png')]);
    }
};
