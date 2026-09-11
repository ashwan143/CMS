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
        Schema::create('blogs', function (Blueprint $table) {

            $table->id();


            // Blog Category
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('blog_categories')
                  ->nullOnDelete();


            // Blog Title
            $table->string('title');


            // URL Slug
            $table->string('slug')
                  ->unique();


            // Short Description
            $table->text('short_description')
                  ->nullable();


            // Full Blog Content
            $table->longText('content');


            // Featured Image
            $table->string('featured_image')
                  ->nullable();


            // Blog Author
            $table->foreignId('author_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();


            // Blog Status
            // Draft = 0
            // Published = 1
            $table->boolean('status')
                  ->default(0);


            // Publish Date
            $table->timestamp('published_at')
                  ->nullable();


            // SEO Fields
            $table->string('seo_title')
                  ->nullable();

            $table->text('seo_description')
                  ->nullable();


            // Display Order
            $table->integer('order')
                  ->default(0);


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
