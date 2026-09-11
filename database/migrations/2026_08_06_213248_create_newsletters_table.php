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
        Schema::create('newsletter', function (Blueprint $table) {

            $table->id();


            // Subscriber Name
            $table->string('name')
                  ->nullable();


            // Subscriber Email
            $table->string('email')
                  ->unique();


            // Subscription Status
            // 1 = Active
            // 0 = Unsubscribed
            $table->boolean('status')
                  ->default(1);


            // Subscription Date
            $table->timestamp('subscribed_at')
                  ->useCurrent();


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter');
    }
};
