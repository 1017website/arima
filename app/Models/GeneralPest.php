<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralPest extends Model
{
    use HasFactory;

    protected $table = 'method_general_pest';

    protected $fillable = [
        'title',
        'description',
        'description_eng',
        'header_image',
    ];
}
