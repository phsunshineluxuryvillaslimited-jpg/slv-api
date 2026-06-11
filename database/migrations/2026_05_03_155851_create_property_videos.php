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
        Schema::create('property_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->string('embed_url_1')
                ->comment('The URL to retrieve the embeddable video from');
            $table->string('embed_url_2')
                ->comment('The URL to retrieve the embeddable video from')
                ->nullable();
            $table->string('virtual_tour_link')
                ->comment('The URL to retrieve the virtual tour from')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_videos');
    }
};
