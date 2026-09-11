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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            // Client / Company Name
            $table->string('name');

            // Client Logo
            $table->string('logo')->nullable();

            // Website URL
            $table->string('website')->nullable();

            // Client Description
            $table->text('description')->nullable();

            // Display Order
            $table->integer('display_order')->default(0);

            // Active / Inactive
            $table->boolean('status')->default(true);

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
        Schema::dropIfExists('clients');
    }
};
