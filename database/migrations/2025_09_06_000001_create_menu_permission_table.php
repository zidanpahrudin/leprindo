<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_permission', function (Blueprint $table) {
            $table->bigIncrements('permission_id');
            // reference user
            $table->unsignedBigInteger('user_id');
            // reference menu
            $table->unsignedBigInteger('menu_id');
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->char('pic_input', 25);
            $table->timestamp('input_time');
            $table->char('pic_edit', 25)->nullable();
            $table->timestamp('edit_time')->nullable();
            // Index akan ditambahkan di migrasi terpisah

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('menu_id')->references('menu_id')->on('mt_menu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_permission');
    }
};
