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
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        $this->insertAmenities();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenities');
    }

    private function insertAmenities(): void
    {
        DB::table('amenities')->insert([
            0=>
            [
                'id'=>1,
                'name'=>'A/C in Rooms'

            ],
            1=>
            [
                'id'=>2,
                'name'=>'Spa'

            ],
            2=>
            [
                'id'=>3,
                'name'=>'Pool'

            ],
            3=>
            [
                'id'=>4,
                'name'=>'Free Parking'

            ],
            4=>
            [
                'id'=>5,
                'name'=>'Tour Assistance'

            ],
            5=>
            [
                'id'=>6,
                'name'=>'Coffe/Tea'

            ],
            6=>
            [
                'id'=>7,
                'name'=>'Restaurant'
            ],
            7=>
            [
                'id'=>8,
                'name'=>'Yoga Studio'

            ],
            8=>
            [
                'id'=>9,
                'name'=>'Bicycles for Rent'

            ],
            9=>
            [
                'id'=>10,
                'name'=>'Free Wifi'

            ],
            10=>
            [
                'id'=>11,
                'name'=>'Sauna'

            ],
            11=>
            [
                'id'=>12,
                'name'=>'Towels'

            ],
            12=>
            [
                'id'=>13,
                'name'=>'Kitchen'

            ],
            13=>
            [
                'id'=>14,
                'name'=>'Hot Tub'

            ],
            14=>
            [
                'id'=>15,
                'name'=>'Fitness Center'

            ],
            15=>
            [
                'id'=>16,
                'name'=>'Housekeeping'

            ],
            
        ]);
    }
};
