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
        Schema::create('exames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum("type",["cc","efm"]) ;
            $table->unsignedBigInteger("teachers_id");
            $table->foreign('teachers_id')->references('id')->on('users');
            $table->unsignedBigInteger("courses_id");
            $table->foreign('courses_id')->references('id')->on('courses');
            $table->string("duree") ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exames');
    }
};
