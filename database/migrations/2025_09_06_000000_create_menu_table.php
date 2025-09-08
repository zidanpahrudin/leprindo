<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mt_menu', function (Blueprint $table) {
            $table->bigIncrements('menu_id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('name', 100);
            $table->string('url', 255);
            $table->string('icon', 50)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->char('pic_input', 25);
            $table->timestamp('input_time');
            $table->char('pic_edit', 25)->nullable();
            $table->timestamp('edit_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mt_menu');
    }
};
