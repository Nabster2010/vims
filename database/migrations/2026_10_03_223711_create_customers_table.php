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
    Schema::create('customers', function (Blueprint $table) {

        $table->id();

        $table->string('customer_type', 20);

        $table->string('identity_type', 30);

        $table->string('name');

        $table->string('identity_number')->unique();

        $table->string('vat_number')->nullable();

        $table->string('mobile', 20);

        $table->string('email')->nullable();

        $table->text('address')->nullable();

        $table->text('notes')->nullable();

        $table->boolean('is_active')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
