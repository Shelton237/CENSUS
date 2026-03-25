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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            // Step 1: Identité
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['M', 'F']);
            $table->date('birth_date');
            $table->string('id_card_number')->unique();

            // Step 2: Contact
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('region');
            $table->string('city');
            $table->string('address');

            // Step 3: Expérience
            $table->string('education_level');
            $table->json('languages')->nullable();
            $table->boolean('previous_experience')->default(false);
            $table->text('experience_details')->nullable();
            
            // Status and tracking
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
