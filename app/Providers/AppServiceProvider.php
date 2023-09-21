<?php

namespace App\Providers;

use App\Service\EventService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addEventsHeaderToMenuAdminLte();
        $this->addEventsToMenuAdminLte();
        $this->addMyEventsHeaderToMenuAdminLte();
        $this->addMyEventsToMenuAdminLte();

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
        //ToDo убрать заглушку
        //$userId = Auth::user()->id;
        $userId = 1;
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
}
