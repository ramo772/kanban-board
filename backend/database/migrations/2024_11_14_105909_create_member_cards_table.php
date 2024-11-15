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
        Schema::create('member_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->integer('age');
            $table->string('email');
            $table->integer('order')->default(0);
            $table->string('mobile_number');
            $table->enum('status', ['un_claimed', 'first_contact', 'preparing_work_offer', 'send_to_therapist'])->default('un_claimed');
            $table->unique(['email', 'status']);
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_cards');
    }
};
