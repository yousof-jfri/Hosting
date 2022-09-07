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
        Schema::create('feed_backs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('feedback');
            $table->string('feedback_file')->nullable();
            $table->enum('type', ['readed', 'unreaded', 'answered', 'inProgress'])->default('unreaded');
            $table->enum('issue', ['upload', 'watch', 'normalUser', 'VIPUser', 'discount_price', 'license', 'more', 'site_problems', 'report']);
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
        Schema::dropIfExists('feed_backs');
    }
};
