<?php

namespace App\Http\Controllers\Customer;

use App\Application;
use App\Http\Controllers\Controller;
use App\OwnershipTransfer;
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

    public function plotsAdvert()
    {
        return view('pages.customer.plots-advert');
    }

    public function cancelTransfer(Request $request)
    {
        $transfer = OwnershipTransfer::where('plot_no',$request->id)->first();
        $transfer->delete();
        $plot = Plot::where('plot_no',$request->id)->first();
        $plot->status = 'approved';
        $plot->save();

        return redirect()->back()->with('status','Successfully cancelled plot transfer');
    }
}
