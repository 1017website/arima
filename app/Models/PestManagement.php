<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PestManagement extends Model
{
    use HasFactory;

    protected $table = 'pest_management_quality';

    protected $fillable = [
        'title',
        'title_eng',
        'description',
        'description_eng',
    ];

    public function logoPest()
    {
        return $this->hasMany(PestManagementImage::class, 'id_management');
    }
}
