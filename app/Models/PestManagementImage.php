<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PestManagementImage extends Model
{
    use HasFactory;

    protected $table = 'pest_management_image';

    protected $fillable = [
        'title',
        'id_management',
        'logo',
    ];

    public function logoPest()
    {
        return $this->belongsToMany(PestManagement::class);
    }
}
