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
        Schema::create('albums', function (Blueprint $table) {

            $table->id();


            // Album Title
            // Example: Robotics Workshop
            $table->string('title');


            // URL Slug
            $table->string('slug')
                  ->unique();


            // Album Description
            $table->text('description')
                  ->nullable();


            // Album Cover Image
            $table->string('cover_image')
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
        Schema::dropIfExists('albums');
    }
};
