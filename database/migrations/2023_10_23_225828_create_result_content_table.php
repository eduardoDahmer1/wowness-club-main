<?php

use App\Models\Result;
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
        Schema::create('result_content', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Result::class)->constrained()->cascadeOnDelete();
            $table->foreignUuid('content_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_content');
    }
};
