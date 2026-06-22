<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');   // Viewing, Take-on, Miscellaneous
            $table->string('assigned_to');  // member name, matches keys in config('team.members')
            $table->date('event_date');
            $table->time('event_time');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['assigned_to', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diaries');
    }
};