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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('last_name');
            $table->string('birthday')->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('company')->nullable();
            $table->string('image')->default('assets/images/users/default.png');
            $table->string('company_registration_number')->unique()->nullable();
            $table->string('company_type')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('company_exact_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('card_number')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_vip')->default(0);
            $table->enum('limited', [0, 'limited', 'money', 'profit'])->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
