<?php

namespace App\Providers;

use App\Advert;
use App\Application;
use App\Appointment;
use App\Http\View\ProfileComposer;
use App\OwnershipTransfer;
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
        View::composer(['pages.customer.*',], ProfileComposer::class);
        View::composer(['pages.customer.*',], function ($view){
            return $view->with('adverts',Advert::all());
        });
        View::composer(['pages.customer.*',], function ($view){
            return $view->with('plots',Plot::where('owner_id',Auth::user()->id)->get());
        });
        View::composer(['pages.customer.*','pages.admin.statistics-archives'], function ($view){

            return $view->with('users',User::all()->load('profile'));
        });
        View::composer(['pages.admin.statistics-archives',], function ($view){
            return $view->with('plots',Plot::all()->load('user'));
        });
        View::composer(['pages.customer.*',], function ($view){
            return $view->with('applications',Application::where('user_id',Auth::user()->id)->get());
        });
        View::composer(['pages.admin.*',], function ($view){
            return $view->with('applications',Application::all()->load(['user.profile','appointments']));
        });
        View::composer(['pages.admin.*'], function ($view){
            return $view->with('ownershipTransfer',OwnershipTransfer::all()->load([
                'user.profile',
                'transferee.profile',
                'plot',
            ]));
        });
        View::composer(['pages.admin.*'],function ($view){
            return $view->with('appointments',Appointment::all()->load('user.profile'));
        });
        View::composer(['pages.admin.*'],function ($view){
            $events = [];
            foreach (Appointment::all()->load('user.profile') as $ap){
                $events[] = [
                    'title'=>'Plot Interview',
                    'start'=>$ap->date,
                    'venue' =>$ap->venue,
                    'extendedProps'=> [
                        'description'=>'Plot Interview with '. $ap->user->name
                            . ' at '.$ap->venue,
                    ],
                ];
            }
            return $view->with(compact('events'));
        });
    }
}
