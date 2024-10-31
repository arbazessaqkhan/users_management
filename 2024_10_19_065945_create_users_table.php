<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('user_name');
            $table->unsignedBigInteger('email_id')->nullable();
            $table->unsignedBigInteger('phone_number_id')->nullable();
            $table->unsignedBigInteger('address_id');

            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('phone_number_id')->references('id')->on('phone_numbers')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
