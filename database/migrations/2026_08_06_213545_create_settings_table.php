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
        Schema::create('settings', function (Blueprint $table) {

            $table->id();


            // Setting Key
            // Example: site_name, logo, phone
            $table->string('key')
                  ->unique();


            // Setting Value
            // Text, URL, JSON data
            $table->longText('value')
                  ->nullable();


            // Data Type
            // text, image, json, number
            $table->string('type')
                  ->default('text');


            // Setting Group
            // general, social, contact
            $table->string('group')
                  ->default('general');


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
        Schema::dropIfExists('settings');
    }
};
