<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mt_salary_history', function (Blueprint $table) {
            $table->bigIncrements('salary_history_id');
            $table->char('biodata_id', 25);
            $table->double('old_value');
            $table->double('new_value');
            $table->date('effect_date');
            $table->char('pic_input', 25);
            $table->dateTime('input_time');
        });

        Schema::table('mt_salary', function (Blueprint $table) {
            $table->unsignedBigInteger('salary_history_id')->nullable();
            $table->foreign('salary_history_id')
                  ->references('salary_history_id')
                  ->on('mt_salary_history');
        });
    }

    public function down(): void
    {
        Schema::table('mt_salary', function (Blueprint $table) {
            $table->dropForeign(['salary_history_id']);
            $table->dropColumn('salary_history_id');
        });

        Schema::dropIfExists('mt_salary_history');
    }
};
