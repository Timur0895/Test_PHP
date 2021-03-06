<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'material_id'
    ];

    public function materials(){
        return $this->belongsToMany(Material::class, 'tag_item');
    }
}
