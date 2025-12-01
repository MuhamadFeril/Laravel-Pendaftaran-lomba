<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'team_name',
        'user_id',
        'event_id',
        'created',
        'updated'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
