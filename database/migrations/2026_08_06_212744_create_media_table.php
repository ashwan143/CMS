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
        Schema::create('media_library', function (Blueprint $table) {

            $table->id();


            // Original File Name
            // Example: banner.jpg
            $table->string('file_name');


            // Stored File Path
            // Example: uploads/images/banner.jpg
            $table->string('file_path');


            // File Type
            // Example: image, video, pdf
            $table->string('file_type');


            // File Extension
            // Example: jpg, png, pdf
            $table->string('extension')
                  ->nullable();


            // File Size in KB/MB
            $table->string('file_size')
                  ->nullable();


            // Image ALT Text for SEO
            $table->string('alt_text')
                  ->nullable();


            // Uploaded By User
            $table->foreignId('uploaded_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();


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
        Schema::dropIfExists('media_library');
    }
};
