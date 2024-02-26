<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            /* Required */
            $table->string('title');
            $table->string('thumbnail');
            $table->string('url');
            $table->foreignUuid('user_id')->constrained();
            $table->boolean('status')->default(1);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('subtitle');
            $table->text('description');

            /* Nullable */
            $table->string('slug')->nullable();

            /* ENUM */
            $table->unsignedInteger('type');
            $table->unsignedInteger('aimed'); 
            $table->unsignedInteger('target');
            $table->unsignedInteger('cost');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contents');
    }
}

