<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('hero_video')->nullable();
            $table->text('hero_video_url')->nullable();
            $table->string('hero_poster')->nullable();
            $table->text('hero_poster_url')->nullable();
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_eyebrow_eng')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_title_eng')->nullable();
            $table->text('hero_description')->nullable();
            $table->text('hero_description_eng')->nullable();
            $table->string('hero_primary_cta')->nullable();
            $table->string('hero_primary_cta_eng')->nullable();
            $table->string('hero_secondary_cta')->nullable();
            $table->string('hero_secondary_cta_eng')->nullable();
            $table->string('client_kicker')->nullable();
            $table->string('client_kicker_eng')->nullable();
            $table->string('client_title')->nullable();
            $table->string('client_title_eng')->nullable();
            $table->text('client_description')->nullable();
            $table->text('client_description_eng')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_title_eng')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_description_eng')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_keywords_eng')->nullable();
            $table->string('og_image')->nullable();
            $table->text('analytics_head')->nullable();
            $table->text('analytics_body')->nullable();
            $table->timestamps();
        });

        Schema::create('home_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->string('subtitle_eng')->nullable();
            $table->string('logo')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_clients');
        Schema::dropIfExists('home_contents');
    }
};
