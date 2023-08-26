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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('target'); //email or phone
            $table->string('code');
            $table->enum('type',['email','phone'])->default('phone');
            $table->timestamp('expires_at')->nullable();
            $table->nullableMorphs('user'); //user_id, user_type (user_id = 1, user_type = App\Models\User //driver or user or employee
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
