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
        Schema::create('property_contact_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->enum('category', ['Vendor', 'Agent', 'Developer', 'Bank'])
                ->comment('The category of the contact detail');
            $table->string('first_name')
                ->comment('The first name of the contact');
            $table->string('last_name')
                ->comment('The last name of the contact');
            $table->string('email')
                ->comment('The email address of the contact');
            $table->string('phone_number')
                ->comment('The phone number of the contact');
            $table->string('mobile_number')
                ->comment('The mobile number of the contact')
                ->nullable();
            $table->enum('type', ['vendor', 'landlord'])
                ->comment('The preferred contact method for the contact')
                ->nullable();
            $table->string('source')
                ->comment('The source of the contact details')
                ->nullable();
            $table->text('notes')
                ->comment('Additional notes about the contact')
                ->nullable();
            $table->string('lawyer_first_name')
                ->comment('The first name of the contact\'s lawyer')
                ->nullable();
            $table->string('lawyer_last_name')
                ->comment('The last name of the contact\'s lawyer')
                ->nullable();
            $table->string('lawyer_email')
                ->comment('The email address of the contact\'s lawyer')
                ->nullable();
            $table->string('lawyer_phone_number')
                ->comment('The phone number of the contact\'s lawyer')
                ->nullable();
            $table->text('lawyer_address')
                ->comment('The address of the contact\'s lawyer')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_contact_detials');
    }
};
