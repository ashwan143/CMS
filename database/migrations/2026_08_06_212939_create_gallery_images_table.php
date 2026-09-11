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
        Schema::create('gallery_images', function (Blueprint $table) {

            $table->id();


            // Album Reference
            $table->foreignId('album_id')
                  ->constrained('albums')
                  ->cascadeOnDelete();


            // Image Path
            $table->string('image');


            // Image Title
            $table->string('title')
                  ->nullable();


            // SEO Alt Text
            $table->string('alt_text')
                  ->nullable();


            // Display Order
            $table->integer('order')
                  ->default(0);


            // Active / Inactive
            $table->boolean('status')
                  ->default(1);


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
