<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermiteBaiting extends Model
{
    use HasFactory;

    protected $table = 'method_termite_baiting';

    protected $fillable = [
        'title',
        'description',
        'description_eng',
        'header_image',
    ];
}
