<?php

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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('poster');
            $table->string('video');
            $table->string('justification');
            $table->string('teaser');
            $table->string('director');
            $table->string('genre');
            $table->string('release');
            $table->string('price');
            $table->string('country');
            $table->unsignedBigInteger('views')->default(0);
            $table->string('discountFromUser');
            $table->string('discountFromProgram');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
