<?php

use App\Models\Contact;
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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignid("user_id")->nullable()->constrained()->nullOnDelete();
            $table->string("fullname")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->longText("content");
            $table->enum('message_status', Contact::MESSAGE_STATUS)->default(Contact::PENDING);
            $table->enum('message_types', Contact::MESSAGE_TYPE);

            $table->timestamp("read_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};



