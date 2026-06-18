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
        Schema::create('property_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->string('region')
                ->index()
                ->nullable()
                ->comment('Property region, e.g. "South East", "North West", etc. 
                    This is a required field for properties in the UK, but optional for properties in other countries.');
            $table->string('town_city')
                ->index()
                ->comment('Town or city in which the property is located')
                ->nullable();
            $table->string('locality')
                ->comment('Locality or suburb in which the property is located')
                ->nullable();
            $table->decimal('latitude', 10, 8)
                ->comment('The exact latitude of the property')
                ->nullable();
            $table->decimal('longitude', 11, 8)
                ->comment('The exact longitude of the property')
                ->nullable();
            $table->integer('accuracy')
                ->comment('Accuracy of the property location in meters')
                ->nullable();
            $table->string('map_address', 255)
                ->comment('Address from google maps is the full address of the property as 
                    it should appear on a map, including street name, number, and postal code')
                ->nullable();
            $table->integer('map_accuracy')
                ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_addresses');
    }
};
