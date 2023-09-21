<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'title',
        'text',
        'date_creation',
        'creator_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(
            User::class,
            EventMember::class,
            'member_id',
            'event_id');
    }
}
