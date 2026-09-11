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
        Schema::create('services', function (Blueprint $table) {

            $table->id();


            // Service Name
            // Example: Robotics Training
            $table->string('title');


            // URL Slug
            // Example: robotics-training
            $table->string('slug')
                  ->unique();


            // Small Description
            $table->text('short_description')
                  ->nullable();


            // Full Service Details
            $table->longText('description')
                  ->nullable();


            // Service Icon
            // Example: fa-robot
            $table->string('icon')
                  ->nullable();


            // Service Image
            $table->string('image')
                  ->nullable();


            // Display Order
            $table->integer('order')
                  ->default(0);


            // Active / Inactive
            $table->boolean('status')
                  ->default(1);


            // Created By Admin
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
