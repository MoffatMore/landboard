<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\OwnershipTransfer;
use App\Plot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlotController extends Controller
{
    //
    public function transfer(Request $request)
    {
        $transfer = OwnershipTransfer::create([
            'owner_id' => Auth::user()->id,
            'plot_no' => $request->plot_no,
            'transferee_id'=>$request->transferee,
        ]);
        if ($transfer){
            Session::flash('status', 'Successfully requested a plot transfer');
            $plot = Plot::where('plot_no',$request->plot_no)->first();
            $plot->update([
                'status' =>'transfer'
            ]);
        }else{
            Session::flash('status', 'Failed to transfer a plot');
        }

        return redirect()->back();
    }
}
