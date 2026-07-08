<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residential extends Model
{
    use HasFactory;

    protected $table = 'service_residential';

    protected $fillable = [
        'title',
        'description',
        'description_eng',
        'background',
        'list_type',
    ];
}
