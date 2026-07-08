<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBugs extends Model
{
    use HasFactory;

    protected $table = 'pest_detail_bugs';

    protected $fillable = [
        'title_bugs',
        'id_pest_bugs',
        'image',
        'latin_title',
    ];

    public function bugTypes()
    {
        return $this->belongsToMany(Bug::class);
    }
}
