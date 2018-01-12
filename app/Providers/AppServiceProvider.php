<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Jenssegers\Date\Date;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setlocale(LC_TIME, config('app.locale'));
        Carbon::setLocale('es');
         setlocale(LC_TIME, 'es');
         Date::setLocale('es');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
