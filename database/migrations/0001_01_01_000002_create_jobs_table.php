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
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();

            // Job Title
            $table->string('title');

            // URL Slug
            $table->string('slug')->unique();

            // Job Department
            $table->string('department')->nullable();

            // Job Location
            $table->string('location')->nullable();

            // Employment Type
            // Example: Full Time, Part Time, Contract
            $table->string('employment_type')->nullable();

            // Required Experience
            $table->string('experience')->nullable();

            // Salary / Salary Range
            $table->string('salary')->nullable();

            // Short Description
            $table->text('short_description')->nullable();

            // Full Job Description
            $table->longText('description')->nullable();

            // Job Requirements
            $table->longText('requirements')->nullable();

            // Job Responsibilities
            $table->longText('responsibilities')->nullable();

            // Application Email
            $table->string('application_email')->nullable();

            // Application Deadline
            $table->date('deadline')->nullable();

            // Display Order
            $table->integer('order')->default(0);

            // Active / Inactive
            $table->boolean('status')->default(true);

            // Featured Job
            $table->boolean('is_featured')->default(false);

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

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
        Schema::dropIfExists('job_openings');
    }
};
