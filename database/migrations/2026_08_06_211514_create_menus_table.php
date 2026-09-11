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
        Schema::create('menus', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Parent Menu
            |--------------------------------------------------------------------------
            | NULL = Top-level menu
            |
            | Example:
            | Services
            | ├── Web Development
            | ├── Mobile App Development
            | └── Software Solutions
            |
            */
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('menus')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Menu Title
            |--------------------------------------------------------------------------
            */
            $table->string('title');

            /*
            |--------------------------------------------------------------------------
            | Menu Type
            |--------------------------------------------------------------------------
            | page         = Existing CMS page
            | custom_url   = Internal/custom URL
            | external_url = External website URL
            */
            $table->enum('type', [
                'page',
                'custom_url',
                'external_url',
            ])->default('page');

            /*
            |--------------------------------------------------------------------------
            | Page Relationship
            |--------------------------------------------------------------------------
            | Used when type = page
            */
            $table->foreignId('page_id')
                ->nullable()
                ->constrained('pages')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Menu URL
            |--------------------------------------------------------------------------
            | Used for custom_url / external_url
            */
            $table->string('url')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Menu Icon
            |--------------------------------------------------------------------------
            | Example:
            | bi bi-house
            | bi bi-briefcase
            */
            $table->string('icon')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Link Target
            |--------------------------------------------------------------------------
            | _self  = same tab
            | _blank = new tab
            */
            $table->enum('target', [
                '_self',
                '_blank',
            ])->default('_self');

            /*
            |--------------------------------------------------------------------------
            | Display Order
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('display_order')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Menu Location
            |--------------------------------------------------------------------------
            */
            $table->enum('location', [
                'header',
                'footer',
                'mobile',
                'sidebar',
            ])->default('header');

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            | 1 = Active
            | 0 = Inactive
            */
            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index('parent_id');
            $table->index('page_id');
            $table->index('location');
            $table->index('status');
            $table->index('display_order');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
