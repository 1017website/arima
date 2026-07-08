<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('password');
            }

            if (! Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('address');
            }

            if (! Schema::hasColumn('users', 'photo_profile')) {
                $table->string('photo_profile')->nullable()->after('phone_number');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'phone_number', 'photo_profile']);
        });
    }
};
