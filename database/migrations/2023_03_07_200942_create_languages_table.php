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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        $this->insertLanguages();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }

    private function insertLanguages(): void
    {
        DB::table('languages')->insert([
            0=>
            [
                'id'=>1,
                'name'=>'English'
            ],
            1=>
            [
                'id'=>2,
                'name'=>'Spanish'
            ],
            2=>
            [
                'id'=>3,
                'name'=>'Portuguese'
            ],
            3=>
            [
                'id'=>4,
                'name'=>'French'
            ],
            4=>
            [
                'id'=>5,
                'name'=>'Mandarin'
            ],
        ]);
    }
};
