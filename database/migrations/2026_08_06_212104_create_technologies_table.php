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
        Schema::create('technologies', function (Blueprint $table) {

            $table->id();


            // Technology Name
            // Example: Laravel, Python
            $table->string('name');


            // Unique Slug
            // Example: laravel, python
            $table->string('slug')
                  ->unique();


            // Technology Icon
            // Example: laravel.png
            $table->string('icon')
                  ->nullable();


            // Technology Description
            $table->text('description')
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
        Schema::dropIfExists('technologies');
    }
};
