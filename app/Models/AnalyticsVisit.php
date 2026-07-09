<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticsVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visited_at',
        'path',
        'full_url',
        'route_name',
        'locale',
        'method',
        'referrer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'device',
        'browser',
        'ip_hash',
        'session_hash',
        'user_agent',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
