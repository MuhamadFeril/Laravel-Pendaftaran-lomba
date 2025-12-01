<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'date',
        'subcategory_id',
        'created',
        'updated'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
