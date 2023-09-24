<?php

use App\Models\Event;
use App\Models\EventMember;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('user:create {login}', function ($login) {
    $user = User::query()->create([
        'first_name' => 'test',
        'second_name' => 'test',
        'login' => $login,
        'registration_date' => now(),
        'password' => bcrypt('admin')
    ]);

    dump($user->createToken('MyApp')->plainTextToken);
});

Artisan::command('event:create {userId}', function ($userId) {
    $event = Event::query()->create([
        'title' => 'test',
        'text' => 'test',
        'date_creation' => now(),
        'creator_id' => $userId
    ]);

    dump($event->id);
});

Artisan::command('event:add-members {eventId} {userId}', function ($eventId, $userId) {
    $eventMember = EventMember::query()->create([
        'event_id' => $eventId,
        'member_id' => $userId
    ]);

    dump($eventMember->id);
});
