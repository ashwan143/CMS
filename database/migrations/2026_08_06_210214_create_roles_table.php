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
        Schema::create('roles', function (Blueprint $table) {

            $table->id();

            // Role Name
            // Example: Admin, Editor, Manager
            $table->string('name');

            // Unique role identifier
            // Example: admin, editor
            $table->string('slug')->unique();

            // Role description
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
        Schema::dropIfExists('roles');
    }
};
