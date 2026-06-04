<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();

            // Identité
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['M', 'F']);
            $table->date('birth_date');
            $table->string('id_card_number');

            // Coordonnées
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('region');
            $table->string('city');

            // Qualifications
            $table->string('education_level');
            $table->string('languages')->nullable();
            $table->string('previous_experience')->nullable();
            $table->text('experience_details')->nullable();
            $table->enum('has_smartphone', ['oui', 'non'])->nullable();
            $table->enum('fonctionnaire', ['oui', 'non'])->nullable();

            // Suivi
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
