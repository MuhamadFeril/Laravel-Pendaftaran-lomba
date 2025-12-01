<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // keep authentication features

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name','email','password','role'];

    protected $hidden = ['password'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    public $timestamps = false;
}
