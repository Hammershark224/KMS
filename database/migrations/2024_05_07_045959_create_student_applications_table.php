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
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id("student_ID");
            $table->foreignId("parent_ID")->references("parent_ID")->on("parent_details");
            $table->string('full_name');
            $table->string('ic')->unique();
            $table->enum('gender',["male", "female"]);
            $table->date('date_birth');
            $table->text('address');
            $table->enum('status', ["applied", "reviewed","rejected","accepted"]);
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_applications');
    }
};
