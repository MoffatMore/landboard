<?php

namespace App\Providers;

use App\Advert;
use App\Application;
use App\Http\View\ProfileComposer;
use App\Plot;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //
        View::composer(['pages.customer.*'], ProfileComposer::class);
        View::composer(['pages.customer.*'], function ($view){
            return $view->with('adverts',Advert::all());
        });
        View::composer(['pages.customer.*'], function ($view){
            return $view->with('plots',Plot::where('owner_id',Auth::user()->id)->get());
        });
        View::composer(['pages.customer.*'], function ($view){
            return $view->with('applications',Application::where('user_id',Auth::user()->id)->get());
        });

    }
}
