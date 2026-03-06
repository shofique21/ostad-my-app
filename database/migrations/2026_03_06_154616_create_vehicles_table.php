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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete('id');
            $table->foreignId('category_id')->constrained('catregories')->cascadeOnDelete('id');
            $table->string('title');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->bigInteger('year')->nullable();
            $table->string('condition')->nullable();
            $table->string('milage')->nullable();
            $table->enum('fuel_type',['Petrol','Diesel','Electric','Hybrid'])->nullable();
            $table->string('transmission')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('contact_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
