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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignid("user_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId('bike_type_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bike_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->double('price_bike_per_minute');
            $table->integer('total_price_trip');
            $table->float('discount')->nullable();
            $table->integer('total_after_discount')->nullable();
            $table->double('tax');
            $table->double('total_after_tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
