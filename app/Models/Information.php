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
    ];
}
