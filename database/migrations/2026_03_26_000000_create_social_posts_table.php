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
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // 'fb', 'x', 'ig'
            $table->string('platform_name'); // 'Facebook', 'X', 'Instagram'
            $table->string('user'); // Ex: 'Census Kamerun'
            $table->string('handle'); // Ex: '@CensusCam'
            $table->string('date'); // Ex: '24 Mar.'
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('likes')->nullable();
            $table->string('comments')->nullable();
            $table->string('shares')->nullable();
            $table->string('link')->nullable(); // External link to the original post
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_posts');
    }
};
