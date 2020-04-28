<?php

namespace App\Http\Controllers\Customer;

use App\Application;
use App\Http\Controllers\Controller;
use App\Plot;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('pages.customer.dashboard');
    }

    public function myPlots()
    {
        $user = Auth::user()->load('plots');
        if ($user->plots->count() > 0){
            return view('pages.customer.manage-plots')->with('plots',$user->plots);
        }
        return view('pages.customer.manage-plots');
    }
}
