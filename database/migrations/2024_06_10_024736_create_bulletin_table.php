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
        Schema::create('bulletin', function (Blueprint $table) {
            $table->id('bulletinId');
            $table->string('bulletinTitle');
            $table->date('publishDate');
            $table->text('bulletinDetails');
            $table->integer('createdBy');
            $table->datetime('createdAt');
            $table->datetime('updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletin');
    }
};
