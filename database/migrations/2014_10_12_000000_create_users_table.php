<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id("user_ID");
            $table->string('ic')->unique();
            $table->string('full_name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string("phone_num")->unique();
            $table->enum('gender',["male", "female"]);
            $table->enum("role", ["k_admin", "parent","muip","staff"]);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Users');
    }
};
