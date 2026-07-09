<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_visits', function (Blueprint $table) {
            $table->id();
            $table->timestamp('visited_at')->index();
            $table->string('path')->index();
            $table->text('full_url')->nullable();
            $table->string('route_name')->nullable()->index();
            $table->string('locale', 8)->nullable()->index();
            $table->string('method', 12)->default('GET');
            $table->string('referrer')->nullable();
            $table->string('utm_source')->nullable()->index();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('device', 32)->nullable()->index();
            $table->string('browser', 64)->nullable();
            $table->string('ip_hash', 64)->nullable()->index();
            $table->string('session_hash', 64)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_visits');
    }
};
