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
        Schema::create('property_external_feeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
            ->references('id')
            ->on('properties')
            ->onDelete('cascade');
            $table->unsignedBigInteger('external_feed_id')->index()
                ->comment('The unique identifier for the property in the external feed');
            $table->string('xml_feed_source')->index()
                ->comment('The source of the external feed (e.g., "Ultra XML")')
                ->nullable();
            $table->string('property_url')->nullable()
                ->comment('The URL of the external feed where this property data was sourced from');
            $table->string('property_type')->nullable()
                ->comment('The property type as specified in the external feed');
            $table->datetime('property_date')->nullable()
                ->comment('The date from which the property data is valid in the external feed');
            $table->char('price_freq')
                ->nullable()
                ->comment('The frequency of the price (e.g., "monthly", "yearly") as specified in the external feed');
            $table->integer('part_owner')
                ->default(0 )
                ->comment('The percentage of ownership for the property as specified in the external feed');
            $table->datetime('imported_at')->nullable()
                ->comment('The date and time when the property data was imported from the external feed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_external_feed');
    }
};
