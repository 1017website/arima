<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;

    protected $table = 'pest_bugs';

    protected $fillable = [
        'types',
        'title',
        'title_eng',
        'icon',
        'header_image',
        'ekosistem',
        'ekosistem_eng',
        'funfact',
        'funfact_eng',
        'penanggulangan',
        'penanggulangan_eng',
    ];

    public function detailBugs()
    {
        return $this->hasMany(DetailBugs::class, 'id_pest_bugs');
    }
}
