<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    // Relasi ke Event melalui Subcategory
    public function events()
    {
        return $this->hasManyThrough(Event::class, Subcategory::class);
    }
}
