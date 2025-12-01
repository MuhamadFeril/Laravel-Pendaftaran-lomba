<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi mass assignment
    protected $fillable = ['name', 'category_id'];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Event (satu subkategori memiliki banyak event)
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
