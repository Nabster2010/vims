<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->string('request_origin')
                ->nullable()
                ->after('request_date');

            $table->string('modification_center_report_no')
                ->nullable()
                ->after('request_origin');

            $table->text('modification_description')
                ->nullable()
                ->after('modification_center_report_no');

            $table->boolean('is_authorized_modification_center')
                ->default(false)
                ->after('modification_description');
        });
    }

    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropColumn([
                'request_origin',
                'modification_center_report_no',
                'modification_description',
                'is_authorized_modification_center',
            ]);
        });
    }
};
