<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('components.navbar', function ($view) {
            $view->with('current_locale', App::currentLocale());
            $view->with('all_locales', config('app.all_locales'));
        });
    }
}
