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
        Schema::create('exam_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exames_id");
            $table->foreign('exames_id')->references('id')->on('exames');
            $table->unsignedBigInteger("users_id");
            $table->foreign('users_id')->references('id')->on('users');
            $table->string("note") ;
            $table->string("comment") ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_records');
    }
};
