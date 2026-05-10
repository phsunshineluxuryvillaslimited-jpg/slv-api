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
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('properties');
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('property_type_id');
            $table->foreign('property_type_id')
                ->references('id')
                ->on('property_types');
            $table->string('title')
                ->unique()
                ->comment('Property title');
            $table->text('description')
                ->comment('The full description of the property');
            $table->enum('title_deeds', ['available','not-available'])
                ->default('available')
                ->comment('Whether the title deeds for the property are available');
            $table->enum('leasehold_property', ['yes','no'])
                ->default('no')
                ->comment('Leasehold Property');
            $table->integer('bedrooms')
                ->default(0)
                ->comment('Number of bedrooms');
            $table->integer('bathrooms')
                ->default(0)
                ->comment('Number of bathrooms');
            $table->decimal('build', 8, 2)
                ->default(0)
                ->comment('Build area in square meters');
            $table->decimal('terrace', 8, 2)
                ->default(0)
                ->comment('Terrace area in square meters');
            $table->decimal('plot', 8,2)
                ->comment('Plot area in square meters')
                ->nullable();
            $table->string('plot_description', 255)
                ->comment('Description of the plot area')
                ->nullable();
            $table->unsignedBigInteger('agent_id')
                ->comment('ID of the agent responsible for the property');
            $table->foreign('agent_id')
                ->references('id')
                ->on('users');
            $table->string('year_of_construction', 5)
                ->comment('Year of construction')
                ->nullable();
            $table->enum('pool', ['yes', 'no'])
                ->default('no')
                ->comment('Whether the property has a pool');
            $table->string('pool_description', 255)
                ->comment('Description of the pool')
                ->nullable();
            $table->enum('listing_type', ['resale', 'new'])
                ->default('Resale')
                ->comment('Property listing type: "Resale" for sale, "New" for new');
            $table->enum('plan_zone',['A','B','C'])
                ->default('A')
                ->comment('Plan zone for the property');
            $table->enum('sea_view', ['yes','no'])
                ->default('no')
                ->comment('Whether the property has a sea view');
            $table->enum('for_sale_board', ['yes','no'])
                ->default('no')
                ->comment('Whether the property is on the for sale board');
            $table->enum('save_type', ['draft','finished'])
                ->default('draft');
            $table->timestamps();
        });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
