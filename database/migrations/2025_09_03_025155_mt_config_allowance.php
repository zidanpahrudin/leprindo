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
        Schema::create('mt_config_allowance', function (Blueprint $table) {
            $table->bigIncrements('allowance_id');
            $table->char('biodata_id', 25);
            $table->string('allowance_name', 50);
            $table->string('allowance_formula', 100);
            $table->char('allowance_value', 20);
            $table->string('desc', 255);
            $table->dateTime('input_time');
            $table->dateTime('edit_time');
            $table->string('pic_input', length: 25);
            $table->string('pic_edit', length: 25);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_config_allowance');
    }
};
