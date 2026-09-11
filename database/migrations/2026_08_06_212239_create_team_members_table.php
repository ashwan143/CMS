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
        Schema::create('team_members', function (Blueprint $table) {

            $table->id();


            // Member Name
            $table->string('name');


            // Designation
            // Example: CEO, Developer
            $table->string('designation')
                  ->nullable();


            // Profile Image
            $table->string('profile_image')
                  ->nullable();


            // Member Biography
            $table->longText('bio')
                  ->nullable();


            // Social Media Links
            // Store JSON:
            // Facebook, LinkedIn, Instagram
            $table->json('social_links')
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
        Schema::dropIfExists('team_members');
    }
};
