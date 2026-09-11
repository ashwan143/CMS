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
        Schema::create('sliders', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Slider Content
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->text('subtitle')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            // Desktop / primary banner
            $table->string('image');

            // Optional mobile-specific banner
            $table->string('mobile_image')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Primary CTA
            |--------------------------------------------------------------------------
            */

            $table->string('button_text')
                ->nullable();

            $table->string('button_url', 2048)
                ->nullable();

            $table->enum('button_target', [
                '_self',
                '_blank',
            ])->default('_self');


            /*
            |--------------------------------------------------------------------------
            | Content Alignment
            |--------------------------------------------------------------------------
            */

            $table->enum('alignment', [
                'left',
                'center',
                'right',
            ])->default('left');


            /*
            |--------------------------------------------------------------------------
            | Display Order
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('display_order')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Scheduling
            |--------------------------------------------------------------------------
            */

            $table->dateTime('start_date')
                ->nullable();

            $table->dateTime('end_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Audit Fields
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('status');

            $table->index('display_order');

            $table->index([
                'status',
                'display_order',
            ]);

            $table->index([
                'start_date',
                'end_date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
