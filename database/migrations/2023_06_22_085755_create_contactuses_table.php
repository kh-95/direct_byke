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
        Schema::create('contactuses', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_link')->nullble();
            $table->string('insta_link')->nullable();
            $table->string('snap_link')->nullable();
            $table->string('whatsapp')->nullable();
            $table->foreignid("added_by_id")->nullable()->constrained('admins')->nullOnDelete();
            $table->string('new_phone')->nullable();
            $table->string('old_phone')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contct_us');
    }




    








};
