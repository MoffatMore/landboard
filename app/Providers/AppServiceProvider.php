<?php

namespace App\Providers;

use App\Http\View\ProfileComposer;
use App\User;
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
        View::composer(['pages.customer.manage-plots'],function ($view){
            return $view->with('users',User::all()->load('profile'));
        });
    }
}
