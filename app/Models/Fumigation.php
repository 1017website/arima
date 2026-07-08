<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fumigation extends Model
{
    use HasFactory;

    protected $table = 'method_fumigation';

    protected $fillable = [
        'title',
        'description',
        'description_eng',
        'header_image',
    ];
}
