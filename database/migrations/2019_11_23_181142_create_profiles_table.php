<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->Biginteger('user_id');
            $table->string('user_name');
            $table->string('image_path')->nullable();
            $table->string('age');
            $table->string('gender');
            $table->string('favorite_genre');
            $table->text('introduction');
            $table->timestamps();

            $table->primary('user_id');
            $table->unique('user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
