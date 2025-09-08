<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_allowance', function (Blueprint $table) {
            $table->bigIncrements('allowance_id');
            $table->unsignedBigInteger('salary_id');
            $table->string('year_period', 10);
            $table->string('month_period', 10);
            $table->char('allowance_value', 20);
            $table->string('pic_process', 25);
            $table->dateTime('process_time');

            // foreign key langsung di sini
            $table->foreign('salary_id')
                  ->references('salary_id')
                  ->on('mt_salary') // ← sesuaikan dengan tabel yang benar
                  ->onDelete('cascade');

            // index + unique
            $table->index(['salary_id', 'year_period', 'month_period']);
            $table->unique(['salary_id', 'year_period', 'month_period']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_allowance');
    }
};
