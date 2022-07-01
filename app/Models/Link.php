<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'material_id'
    ];

    public function materials(){
        return $this->belongsToMany(Material::class, 'links');
    }
}
