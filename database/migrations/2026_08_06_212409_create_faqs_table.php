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
        Schema::create('faqs', function (Blueprint $table) {

            $table->id();


            // FAQ Question
            // Example: What is your course duration?
            $table->string('question');


            // FAQ Answer
            $table->longText('answer');


            // FAQ Category
            // Example: Course, Service, General
            $table->string('category')
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
        Schema::dropIfExists('faqs');
    }
};
