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
        Schema::create('results', function (Blueprint $table) {
            $table->id('result_id');
            $table->string('stu_ic');
            $table->string('exam_center');
            $table->string('year');
            $table->string('grade_solat');
            $table->string('grade_pchi');
            $table->string('grade_quran');
            $table->string('grade_jawi');
            $table->string('grade_sirah');
            $table->string('grade_syariah');
            $table->string('grade_adab');
            $table->string('grade_lughah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
