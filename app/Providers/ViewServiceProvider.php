<?php

namespace Curso\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'tickets/list',
            function($view){
                $view->title = trans(Route::currentRouteName().'_title');
                $view->total = Lang::choice(Route::currentRouteName().'_total', $view->tickets->total());
            }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
