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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();

            // Visitor Name
            $table->string('name');

            // Visitor Email
            $table->string('email');

            // Phone Number
            $table->string('phone')->nullable();

            // Subject
            $table->string('subject')->nullable();

            // Message
            $table->longText('message');

            // Read / Unread
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
