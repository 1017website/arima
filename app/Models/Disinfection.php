<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disinfection extends Model
{
    use HasFactory;

    protected $table = 'service_disinfection';

    protected $fillable = [
        'title',
        'description',
        'description_eng',
        'background',
        'list_type',
    ];
}
