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
        Schema::create('publish', function (Blueprint $table) {
            $table->id('publishId');
            $table->foreignId('bulletinId')->references('bulletinId')->on('bulletin');
            $table->integer('publishTo');
            $table->datetime('createdAt');
            $table->datetime('updatedAt');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publish');
    }
};
