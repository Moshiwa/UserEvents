<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    public $appends = [
        'full_name'
    ];

    protected $fillable = [
        'login',
        'password',
        'first_name',
        'second_name',
        'registration_date',
        'birth_date',
        'token'
    ];

    protected $hidden = [
        'password',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name;
    }
}
