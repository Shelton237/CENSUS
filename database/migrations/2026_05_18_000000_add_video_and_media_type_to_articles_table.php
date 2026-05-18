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
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'media_type')) {
                $table->string('media_type')->default('image')->after('category');
            }
            if (!Schema::hasColumn('articles', 'video')) {
                $table->string('video')->nullable()->after('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'media_type')) {
                $table->dropColumn('media_type');
            }
            if (Schema::hasColumn('articles', 'video')) {
                $table->dropColumn('video');
            }
        });
    }
};
