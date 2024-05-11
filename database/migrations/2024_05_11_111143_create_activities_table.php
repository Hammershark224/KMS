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
        Schema::create('activity', function (Blueprint $table) {
            $table->id('activityID');
            $table->string('activityName');
            $table->string('activityDetails');
            $table->string('activityLocation');
            $table->date('activityDate');
            $table->time('startTime');
            $table->time('endTime');
            $table->integer('activityCapacity');
            $table->integer('availableSlot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};
