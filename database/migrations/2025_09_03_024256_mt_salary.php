<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mt_salary', function (Blueprint $table) {
            $table->bigIncrements('salary_id');
            $table->char('biodata_id', 25);
            $table->char('company_id', 25);
            $table->char('company_name', 25);
            $table->char('dept_name', 25);
            $table->integer('basic_salary');
            $table->integer('healthy_allowance');
            $table->integer('positional_allowance');
            $table->char('pic_input', 25);
            $table->timestamp('input_time');
            $table->char('pic_edit', 25)->nullable();
            $table->timestamp('edit_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mt_salary');
    }
};
