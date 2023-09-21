<?php

namespace App\Service;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventService
{
    public function getMenuEvents()
    {
        return Event::query()->select('id', 'title')->get();
    }

    public function getEventsByCreator($userId)
    {
        return Event::query()->select('id', 'title')->where('creator_id', $userId)->get();
    }
}
