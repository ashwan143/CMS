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
        Schema::create('pages', function (Blueprint $table) {

            // Primary Key
            $table->id();

            // Page Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('template')->default('default');

            // Page Summary
            $table->text('short_description')->nullable();

            // Page Content
            $table->longText('content')->nullable();

            // Featured Image
            $table->string('featured_image')->nullable();

            // Page Status
            $table->boolean('status')->default(true);

            // Display Order
            $table->unsignedInteger('display_order')->default(0);

            // Created By Admin
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Updated By Admin
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
