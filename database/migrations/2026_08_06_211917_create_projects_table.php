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
        Schema::create('projects', function (Blueprint $table) {

            $table->id();


            // Project Title
            $table->string('title');


            // URL Slug
            $table->string('slug')
                  ->unique();


            // Project Category
            // Example: Web, AI, Robotics
            $table->string('category')
                  ->nullable();


            // Short Description
            $table->text('short_description')
                  ->nullable();


            // Full Project Details
            $table->longText('description')
                  ->nullable();


            // Project Thumbnail Image
            $table->string('image')
                  ->nullable();


            // Client Name
            $table->string('client_name')
                  ->nullable();


            // Live Project URL
            $table->string('project_url')
                  ->nullable();


            // Project Completion Date
            $table->date('completion_date')
                  ->nullable();


            // Display Order
           $table->integer('display_order')
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
        Schema::dropIfExists('projects');
    }
};
