<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category',
        'title',
        'authors',
        'description',
        'tag_id'
    ];

    public function categori()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function tags()
    {
      return $this->belongsToMany(Tag::class, 'tag_item');
    }

    public function links()
    {
      return $this->belongsToMany(Tag::class, 'links');
    }
}
