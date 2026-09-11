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
        Schema::create('seo', function (Blueprint $table) {

            $table->id();


            // Content Type
            // Example: page, blog, service, project
            $table->string('page_type');


            // Related Content ID
            // Example:
            // page_id
            // blog_id
            // service_id
            $table->unsignedBigInteger('page_id');


            // SEO Meta Title
            $table->string('meta_title')
                  ->nullable();


            // SEO Meta Description
            $table->text('meta_description')
                  ->nullable();


            // SEO Keywords
            $table->text('meta_keywords')
                  ->nullable();


            // Open Graph Image
            $table->string('og_image')
                  ->nullable();


            // Canonical URL
            $table->string('canonical_url')
                  ->nullable();


            // Robots Meta
            // index,follow
            // noindex,nofollow
            $table->string('robots')
                  ->default('index,follow');


            $table->timestamps();


            // Prevent duplicate SEO entry
            $table->unique([
                'page_type',
                'page_id'
            ]);

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo');
    }
};
