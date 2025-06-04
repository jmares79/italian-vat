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
        Schema::create('vat_numbers', function (Blueprint $table) {
            $table->id();

            $table->string('custom_id')->nullable();
            $table->string('number');
            $table->string('country_code', 2);
            $table->boolean('is_valid')->default(false);
            $table->string('status')->nullable();

            $table->timestamps();

            $table->unique(['country_code', 'number'], 'vat_country_code_number_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vat_numbers');
    }
};
