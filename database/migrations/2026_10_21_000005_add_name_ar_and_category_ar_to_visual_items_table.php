<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visual_items', function (Blueprint $table) {
            $table->string('name_ar')->after('name')->nullable();
            $table->string('category_ar')->nullable()->after('category')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('visual_items', function (Blueprint $table) {
            $table->dropColumn([
                'name_ar',
                'category_ar',
            ]);
        });
    }
};
