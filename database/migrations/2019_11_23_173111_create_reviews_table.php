<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');
            $table->Biginteger('user_id');
            $table->Biginteger('game_id');
            $table->integer('review_point');
            $table->string('review_title');
            $table->text('review_content');
            $table->boolean('spoiler_flg');
            $table->timestamps();

            $table->unique(['user_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
