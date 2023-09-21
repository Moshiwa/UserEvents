<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
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
        ]);

        return response()->json([
            'error' => null,
            'result' => $event->id
        ]);
    }

    public function participation(Event $event)
    {
        $userId = Auth::user()->id;

        $event->members()->create([
            'member_id' => $userId
        ]);
    }

    public function cancelParticipation(Event $event)
    {

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
