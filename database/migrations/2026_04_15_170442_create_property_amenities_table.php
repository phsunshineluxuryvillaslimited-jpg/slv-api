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
            $table->integer('amenities')->default(0)->nullable();
            $table->integer('airport')->default(0)->nullable();
            $table->integer('sea')->default(0)->nullable();
            $table->integer('public_transport')->default(0)->nullable();
            $table->integer('schools')->default(0)->nullable();
            $table->integer('resorts')->default(0)->nullable();

            $table->integer('terrace')->default(0)->index();
            $table->integer('attic')->default(0)->nullable();
            $table->integer('roof_garden')->default(0)->nullable();
            $table->integer('covered_veranda')->default(0)->nullable();
            $table->integer('uncovered_veranda')->default(0)->nullable();
            $table->integer('covered_parking')->default(0)->nullable();
            $table->integer('basement')->default(0)->nullable();
            $table->integer('courtyard')->default(0)->nullable();
            $table->integer('garden')->default(0)->nullable();
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
