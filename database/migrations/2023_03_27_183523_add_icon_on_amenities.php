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
        Schema::table('amenities', function (Blueprint $table) {
            $table->string('icon')->nullable();
        });
        $this->updateAmenities();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }

    public function updateAmenities(): void
    {

        DB::table('amenities')
            ->where('id', 1)
            ->update(['icon' => asset('assets/images/icons-amenities/air-conditioning.png')]);

        DB::table('amenities')
            ->where('id', 2)
            ->update(['icon' => asset('assets/images/icons-amenities/spa.png')]);

        DB::table('amenities')
            ->where('id', 3)
            ->update(['icon' => asset('assets/images/icons-amenities/swimming.png')]);

        DB::table('amenities')
            ->where('id', 4)
            ->update(['icon' => asset('assets/images/icons-amenities/parking.png')]);

        DB::table('amenities')
            ->where('id', 5)
            ->update(['icon' => asset('assets/images/icons-amenities/tour-assistance.png')]);

        DB::table('amenities')
            ->where('id', 6)
            ->update(['icon' => asset('assets/images/icons-amenities/coffee.png')]);

        DB::table('amenities')
            ->where('id', 7)
            ->update(['icon' => asset('assets/images/icons-amenities/restaurant.png')]);

        DB::table('amenities')
            ->where('id', 8)
            ->update(['icon' => asset('assets/images/icons-amenities/yoga.png')]);

        DB::table('amenities')
            ->where('id', 9)
            ->update(['icon' => asset('assets/images/icons-amenities/track-bicycle.png')]);

        DB::table('amenities')
            ->where('id', 10)
            ->update(['icon' => asset('assets/images/icons-amenities/wifi-signal.png')]);

        DB::table('amenities')
            ->where('id', 11)
            ->update(['icon' => asset('assets/images/icons-amenities/sauna.png')]);

        DB::table('amenities')
            ->where('id', 12)
            ->update(['icon' => asset('assets/images/icons-amenities/towel.png')]);

        DB::table('amenities')
            ->where('id', 13)
            ->update(['icon' => asset('assets/images/icons-amenities/kitchen-set.png')]);

        DB::table('amenities')
            ->where('id', 14)
            ->update(['icon' => asset('assets/images/icons-amenities/jacuzzi.png')]);

        DB::table('amenities')
            ->where('id', 15)
            ->update(['icon' => asset('assets/images/icons-amenities/dumbbell.png')]);

        DB::table('amenities')
            ->where('id', 16)
            ->update(['icon' => asset('assets/images/icons-amenities/household.png')]);
    }
};
