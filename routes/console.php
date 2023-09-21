<?php

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

Artisan::command('test', function () {
    User::query()->create([
        'first_name' => 'etet',
        'second_name' => 'wef',
        'login' => 'admin',
        'registration_date' => '2023-12-12',
        'password' => bcrypt('admin')
    ]);
    $user = \App\Models\User::query()->first();
    $event = \App\Models\Event::query()->with('members', 'creator')->first();
    dd($event->members->toArray());
});
