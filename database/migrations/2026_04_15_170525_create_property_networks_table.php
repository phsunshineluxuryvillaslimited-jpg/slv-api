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
        Schema::create('property_networks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->string('external_feeds', 200) // right_move,zoopla,barazaki,apits,slv,directs or null
                ->nullable(); 
            $table->string('website_banner', 200) // reduced,reserved,sold,exclusive,new_listing or null
                ->nullable();
            // $table->enum('external_feeds', ['right_move', 'zoopla', 'barazaki', 'apits', 'slv', 'directs'])
            //     ->nullable()
            //     ->comment('Network for third party e.g. slv, zoopla, barzaki, apits');
            // $table->enum('website_banner', ['reduced', 'reserved', 'sold', 'exclusive', 'new_listing', null])
            //     ->nullable()
            //     ->comment('Website banner e.g. reduced, sold, reseved, exclusive and new listing');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('networks');
    }
};
