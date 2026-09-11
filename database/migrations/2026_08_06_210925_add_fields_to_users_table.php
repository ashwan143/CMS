<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('role_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('roles')
                  ->nullOnDelete();


            $table->string('phone')
                  ->nullable()
                  ->after('email');


            $table->string('profile_image')
                  ->nullable();


            $table->boolean('status')
                  ->default(1);


            $table->timestamp('last_login_at')
                  ->nullable();

        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['role_id']);

            $table->dropColumn([
                'role_id',
                'phone',
                'profile_image',
                'status',
                'last_login_at'
            ]);

        });
    }
};
