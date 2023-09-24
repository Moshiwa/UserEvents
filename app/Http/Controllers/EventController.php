<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()->get();

        return response()->json([
            'error' => null,
            'result' => $events
        ]);
    }

    public function get(Event $event)
    {
        return response()->json([
            'error' => null,
            'result' => $event
        ]);
    }

    public function create(EventRequest $request)
    {
        $data = $request->validated();
        $event = Event::query()->create([
            'title' => $data['title'],
            'text' => $data['text'],
            'date_creation' => now(),
            'creator_id' => Auth::user()->id,
        ]);

        return response()->json([
            'error' => null,
            'result' => $event->id
        ]);
    }

    public function participation(Event $event)
    {
        $userId = Auth::user()->id;
        $eventMember = EventMember::query()->firstOrCreate([
            'event_id' => $event->id,
            'member_id' => $userId,
        ]);

        return response()->json([
            'error' => null,
            'result' => $eventMember->id
        ]);
    }

    public function cancelParticipation(Event $event)
    {
        $userId = Auth::user()->id;
        $eventMember = EventMember::query()
            ->where('event_id', $event->id)
            ->where('member_id', $userId)
            ->first();

        if (! empty($eventMember)) {
            $eventMember->delete();

            return response()->json([
                'error' => null,
                'result' => $eventMember->id
            ]);
        }

        return response()->json([
            'error' => 'Entry not found',
            'result' => null
        ]);
    }

    public function remove(Event $event)
    {
        if (Auth::user()->id === $event->creator_id) {
            $event->delete();

            return response()->json([
                'error' => null,
                'result' => true
            ]);
        }

        return response()->json([
            'error' => 'You do not have permission to delete',
            'result' => false
        ]);
    }
}
