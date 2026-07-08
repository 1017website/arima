<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subtitle',
        'subtitle_eng',
        'logo',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
