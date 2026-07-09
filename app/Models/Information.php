<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information';

    protected $fillable = [
        'logo_header',
        'logo_favicon',
        'logo_company',
        'frontend_logo',
        'frontend_favicon',
        'cms_favicon',
        'cms_sidebar_logo',
        'cms_login_logo',
        'name',
        'image',
        'slogan',
        'description',
        'description_eng',
        'address',
        'email',
        'phone_1',
        'phone_2',
        'phone_sms',
        'phone_wa',
        'google_map',
        'link_wa',
        'order_wa',
        'website_link',
        'sebaran_wilayah',
        'meta_title',
        'meta_title_eng',
        'meta_description',
        'meta_description_eng',
        'meta_keywords',
        'meta_keywords_eng',
        'meta_image',
        'google_adsense_client_id',
        'google_ads_head_script',
        'google_ads_body_script',
    ];
}
