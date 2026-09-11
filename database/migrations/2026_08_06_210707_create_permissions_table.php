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
        Schema::create('permissions', function (Blueprint $table) {

            $table->id();

            // Permission Name
            // Example: Create User, Edit Blog
            $table->string('name');

            // Unique permission identifier
            // Example: create-users, edit-users
            $table->string('slug')->unique();

            // Module name
            // Example: Users, Blogs, Pages
            $table->string('module');

            // Permission Description
            $table->text('description')->nullable();

            // Active / Inactive
            $table->boolean('status')->default(1);

            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
