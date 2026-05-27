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
        Schema::create('property_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->decimal('amenities',8,2)->default(0);
            $table->decimal('airport',8,2)->default(0);
            $table->decimal('sea',8,2)->default(0);
            $table->decimal('public_transport',8,2)->default(0);
            $table->decimal('schools',8,2)->default(0);
            $table->decimal('resorts',8,2)->default(0);
            $table->decimal('covered',8,2)->default(0)->index();
            $table->decimal('attic',8,2)->default(0);
            $table->decimal('roof_garden',8,2)->default(0);
            $table->decimal('covered_veranda',8,2)->default(0);
            $table->decimal('uncovered_veranda',8,2)->default(0);
            $table->decimal('covered_parking',8,2)->default(0);
            $table->decimal('basement',8,2)->default(0);
            $table->decimal('courtyard',8,2)->default(0);
            $table->decimal('garden',8,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void 
    {
        Schema::dropIfExists('property_amenities');
    }
};
