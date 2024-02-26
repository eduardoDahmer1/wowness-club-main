<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
            $table->string('slug')->nullable()->unique();
        });

        $this->updateUser();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    public function updateUser()
    {
        $users = User::select('slug', 'id', 'name')->get();
        foreach ($users as $user) {
            $user->slug = Str::slug($user->name . '-' .  Str::substr($user->id, 1, 9));
            $user->save();
        }
    }
};
