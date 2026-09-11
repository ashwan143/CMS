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
        Schema::create('inquiries', function (Blueprint $table) {

            $table->id();


            // Visitor Name
            $table->string('name');


            // Visitor Email
            $table->string('email')
                  ->nullable();


            // Visitor Phone Number
            $table->string('phone')
                  ->nullable();


            // Inquiry Subject
            $table->string('subject')
                  ->nullable();


            // Inquiry Message
            $table->longText('message');


            // Inquiry Type
            // Example: Contact, Course, Service
            $table->string('type')
                  ->nullable();


            // Status
            // 0 = New
            // 1 = Read
            // 2 = Replied
            // 3 = Closed
            $table->integer('status')
                  ->default(0);


            // Assigned Admin/User
            $table->foreignId('assigned_to')
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
        Schema::dropIfExists('inquiries');
    }
};
