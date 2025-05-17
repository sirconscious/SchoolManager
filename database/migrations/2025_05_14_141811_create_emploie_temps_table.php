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
        Schema::create('emploie_temps', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('time_slot');
            $table->string('subject')->nullable();
            $table->string('teacher')->nullable();
            $table->string('room')->nullable();
            $table->enum('grp', ['DEV201', 'DEV202', 'DEV203' ,'DEV204']);
            $table->timestamps();
            
            $table->unique(['day', 'time_slot', 'grp']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploie_temps');
    }
};
