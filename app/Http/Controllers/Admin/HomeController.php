<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use App\OwnershipTransfer;
use App\Plot;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('pages.admin.dashboard');
    }

    public function waitingList()
    {
        return view('pages.admin.waiting-list');
    }

    public function ownershipTransfer()
    {
        return view('pages.admin.ownership-transfer');
    }

    public function statistics()
    {
        return view('pages.admin.statistics-archieves');
    }

    public function appointments()
    {
        return view('pages.admin.appointments');
    }

    public function getSchedule(int $id)
    {
       $schedule = \App\Appointment::where('application_id', $id)->first();
       return $schedule;
    }

    public function rejectApplication(int $id)
    {
        $app = Application::find($id);
        $app->update([
            'status'=>'rejected'
        ]);
        return redirect()->back()->with('status','Successfully rejected an application');
    }

    public function acceptApplication(Request $request)
    {
        $app = Application::find($request->id);
        $app->update([
            'status'=>'accepted'
        ]);

        Plot::create([
            'owner_id' => $app->user_id,
            'location' => $app->plot_location,
            'address' => $app->plot_address,
            'status'   =>'approved',
        ]);
        return redirect()->back()->with('status','Successfully accepted an application');
    }

    public function acceptTransferApplication(Request $request)
    {
        $transfer = OwnershipTransfer::find($request->transfer_id);

        $transfer->update([
            'status' => 'transfered',
        ]);

        $plot = Plot::find($request->plot_id);
        $plot->update([
            'owner_id' => $transfer->transferee_id,
            'status' => 'approved'
        ]);

        return redirect()->back()->with('status','Successfully accepted plot transfer');
    }

    public function rejectTransferApplication(int $id)
    {
        $app = OwnershipTransfer::find($id);
        $app->update([
            'status'=>'rejected'
        ]);
        return redirect()->back()->with('status','Successfully rejected an transfer application');
    }
}
