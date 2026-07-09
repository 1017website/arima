<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_video',
        'hero_video_url',
        'hero_poster',
        'hero_poster_url',
        'hero_eyebrow',
        'hero_eyebrow_eng',
        'hero_title',
        'hero_title_eng',
        'hero_description',
        'hero_description_eng',
        'hero_primary_cta',
        'hero_primary_cta_eng',
        'hero_secondary_cta',
        'hero_secondary_cta_eng',
        'client_kicker',
        'client_kicker_eng',
        'client_title',
        'client_title_eng',
        'client_description',
        'client_description_eng',
        'iso_is_active',
        'iso_kicker',
        'iso_kicker_eng',
        'iso_title',
        'iso_title_eng',
        'iso_description',
        'iso_description_eng',
        'seo_title',
        'seo_title_eng',
        'seo_description',
        'seo_description_eng',
        'seo_keywords',
        'seo_keywords_eng',
        'og_image',
        'analytics_head',
        'analytics_body',
    ];

    protected $casts = [
        'iso_is_active' => 'boolean',
    ];
}

