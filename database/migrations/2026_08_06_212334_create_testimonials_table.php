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
        Schema::create('testimonials', function (Blueprint $table) {

            $table->id();

            // =====================================================
            // CLIENT INFORMATION
            // =====================================================

            // Client / Person Name
            // Example: Rahul Sharma
            $table->string('client_name');

            // Designation
            // Example: CEO, Founder, Director
            $table->string('designation')
                  ->nullable();

            // Company / Organization
            // Example: ABC Technologies Pvt. Ltd.
            $table->string('company_name')
                  ->nullable();

            // Client Profile Photo
            $table->string('client_photo')
                  ->nullable();

            // Company Logo
            $table->string('company_logo')
                  ->nullable();


            // =====================================================
            // TESTIMONIAL
            // =====================================================

            // Client Testimonial
            $table->text('testimonial');

            // Rating: 1 to 5
            $table->unsignedTinyInteger('rating')
                  ->default(5);


            // =====================================================
            // PROJECT RELATION
            // =====================================================

            // Related Software Project
            $table->foreignId('project_id')
                  ->nullable()
                  ->constrained('projects')
                  ->nullOnDelete();


            // =====================================================
            // PUBLISHING
            // =====================================================

            // Draft / Published
            $table->boolean('status')
                  ->default(1);

            // Featured Testimonial
            // Useful for homepage
            $table->boolean('is_featured')
                  ->default(0);

            // Display Order
            $table->integer('display_order')
                  ->default(0);

            // Publish Date
            $table->timestamp('published_at')
                  ->nullable();


            // =====================================================
            // SEO / ACCESSIBILITY
            // =====================================================

            // Client Photo ALT Text
            $table->string('photo_alt')
                  ->nullable();

            // Company Logo ALT Text
            $table->string('logo_alt')
                  ->nullable();


            // =====================================================
            // ADMIN
            // =====================================================

            // Created By Admin
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();


            // =====================================================
            // TIMESTAMPS
            // =====================================================

            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
