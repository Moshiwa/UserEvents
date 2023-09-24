<?php

namespace App\Http\Middleware;

use App\Service\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;


class AdminLteMenuPrepare
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            $this->addEventsHeaderToMenuAdminLte();
            $this->addEventsToMenuAdminLte();
            $this->addMyEventsHeaderToMenuAdminLte();
            $this->addMyEventsToMenuAdminLte();
            $this->addCreateEventButtonToMenuAdminLte();
        }

        return $next($request);
    }

    private function addEventsHeaderToMenuAdminLte()
    {
        $adminLteConfig = \Config::get('adminlte');
        $adminLteConfig['menu'][] = ['header' => 'all_events'];
        \Config::set('adminlte.menu', $adminLteConfig['menu']);
    }

    private function addEventsToMenuAdminLte()
    {
        $EventService = new EventService();
        $events = $EventService->getMenuEvents();
        $adminLteConfig = \Config::get('adminlte');
        $menu = $adminLteConfig['menu'];
        foreach ($events as $event) {
            $menu[] = [
                'text' => $event->title,
                'url' => 'event/' . $event->id,
                'icon' => 'far fa-fw fa-folder'
            ];
        }

        \Config::set('adminlte.menu', $menu);
    }

    private function addMyEventsHeaderToMenuAdminLte()
    {
        $adminLteConfig = \Config::get('adminlte');
        $adminLteConfig['menu'][] = ['header' => 'my_events'];
        \Config::set('adminlte.menu', $adminLteConfig['menu']);
    }

    private function addMyEventsToMenuAdminLte()
    {
        $EventService = new EventService();
        $userId = Auth::user()->id;
        $events = $EventService->getEventsByCreator($userId);
        $adminLteConfig = \Config::get('adminlte');
        $menu = $adminLteConfig['menu'];
        foreach ($events as $event) {
            $menu[] = [
                'text' => $event->title,
                'url' => 'event/my/' . $event->id,
                'icon' => 'far fa-fw fa-folder-open'
            ];
        }

        \Config::set('adminlte.menu', $menu);
    }

    private function addCreateEventButtonToMenuAdminLte()
    {
        $EventService = new EventService();
        $userId = Auth::user()->id;
        $events = $EventService->getEventsByCreator($userId);
        $adminLteConfig = \Config::get('adminlte');
        $menu = $adminLteConfig['menu'];

        $menu[] = [
            'text'       => 'Создать событие',
            'icon_color' => 'blue',
            'url'        => '/event',
        ];

        \Config::set('adminlte.menu', $menu);
    }
}
