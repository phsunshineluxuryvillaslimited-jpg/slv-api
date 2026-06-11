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
        Schema::create('property_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->boolean('is_poa')->default(false);
            $table->decimal('basic_price', 14,2)->default(0);
            $table->decimal('original_price', 10,2)->default(0)->nullable();
            $table->decimal('total_reduction_percentage',10,2)->default(0)->nullable();
            $table->decimal('total_reduction_price', 10,2)->default(0)->nullable();
            $table->decimal('commission', 10,2)->default(0);
            $table->decimal('communal_charge',10,2)->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_prices');
    }
};
