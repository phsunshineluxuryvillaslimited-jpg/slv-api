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
            $table->unsignedBigInteger('property_type_id');
            $table->foreign('property_type_id')
                ->references('id')
                ->on('property_types');
            $table->string('reference', 45)
                ->unique()
                ->index()
                ->comment('Unique reference for this price entry');
            $table->longText('description')
                ->comment('The full description of the property')
                ->nullable();
            $table->enum('title_deeds', ['available', 'not-available'])
                ->nullable()
                ->comment('Whether the title deeds for the property are available');
            $table->enum('leasehold', ['yes', 'no'])
                ->default('yes')
                ->comment('Leasehold Property');
            $table->integer('bedrooms')->index()
                ->default(0)
                ->comment('Number of bedrooms');
            $table->integer('bathrooms')->index()
                ->default(0)
                ->comment('Number of bathrooms');
            $table->integer('area_size', 10)->index()
                ->default(0)
                ->comment('Area area in square meters');
            $table->integer('plot', 10)->index()
                ->default(0)
                ->comment('Plot area in square meters');
            $table->string('plot_description', 255)
                ->comment('Description of the plot area')
                ->nullable();
            $table->integer('managing_agent_user_id');
            $table->string('year_of_construction', 5)
                ->comment('Year of construction')
                ->nullable();
            $table->enum('pool', ['yes', 'no'])
                ->default('yes')
                ->comment('Whether the property has a pool');
            $table->string('pool_description', 255)
                ->comment('Description of the pool')
                ->nullable();
            $table->enum('listing_type', ['resale', 'new_build', 'sale', 'rental'])
                ->nullable()
                ->comment('Property listing type: "Resale" for sale, "New" for new');
            $table->enum('plan_zone', ['A', 'B', 'C'])
                ->nullable()
                ->comment('Plan zone for the property');
            $table->enum('sea_view', ['yes', 'no'])
                ->nullable()
                ->comment('Whether the property has a sea view');
            $table->enum('for_sale_board', ['yes', 'no'])
                ->nullable()
                ->comment('Whether the property is on the for sale board');
            $table->enum('save_type', ['draft', 'finished', 'feed'])->index()
                ->default('draft');
            $table->enum('status', ['published', 'active', 'inactive'])->index()
                ->nullable();
            $table->datetime('published_at')->index()
                ->nullable();
            $table->unsignedBigInteger('agent_id')
                ->nullable()
                ->foreign('agent_id')
                ->references('id')
                ->on('agents');
            $table->unsignedBigInteger('developer_id')
                ->nullable()
                ->foreign('developer_id')
                ->references('id')
                ->on('developers');
            $table->unsignedBigInteger('vendor_id')
                ->nullable()
                ->foreign('vendor_id')
                ->references('id')
                ->on('vendors');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
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
