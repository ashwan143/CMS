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
        Schema::create('blog_categories', function (Blueprint $table) {

            $table->id();


            // Category Name
            // Example: Robotics
            $table->string('name');


            // Category Slug
            // Example: robotics
            $table->string('slug')
                  ->unique();


            // Category Description
            $table->text('description')
                  ->nullable();


            // Category Image
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
        Schema::dropIfExists('blog_categories');
    }
};
