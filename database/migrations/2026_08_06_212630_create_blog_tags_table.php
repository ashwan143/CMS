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
        Schema::create('blog_tags', function (Blueprint $table) {

            $table->id();


            // Tag Name
            // Example: Laravel
            $table->string('name');


            // Unique Slug
            // Example: laravel
            $table->string('slug')
                  ->unique();


            // Active / Inactive
            $table->boolean('status')
                  ->default(1);


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
        Schema::dropIfExists('blog_tags');
    }
};
