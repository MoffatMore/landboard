<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Profile;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Application as App;

class Application extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $applications = App::where('user_id',Auth::user()->id)->get();
        return view('pages.customer.pending-applications')->with('applications',$applications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        //
        return view('pages.customer.application');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $profile = Profile::find(Auth::user()->id);
        if ($profile){
            $profile->update([
                'last' => $request->last,
                'contacts'=> $request->contacts,
                'dob'=>$request->dob,
                'postal_address'=> $request->postal_address,
                'physical_address'=>$request->physical_address
            ]);
            App::create([
                'user_id' =>Auth::user()->id,
                'plot_location' => $request->plot_location,
                'plot_address'=> $request->plot_address,
            ]);

        }else{
            Profile::create([
                'user_id' =>Auth::user()->id,
                'last' => $request->last,
                'contacts'=> $request->contacts,
                'dob'=>$request->dob,
                'postal_address'=> $request->postal_address,
                'physical_address'=>$request->physical_address,
                'gender'=> $request->gender,
            ]);
            App::create([
                'user_id' =>Auth::user()->id,
                'plot_location' => $request->plot_location,
                'plot_address'=> $request->plot_address,
            ]);
        }

        return redirect()
            ->route('customer.dashboard')
            ->with('status','Successfully submitted application');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $app
     *
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $app = App::find($id);
        if($app->update($request->all())){
            Session::flash('status', 'Successfully updated the application');
        }else{
            Session::flash('status', 'Failed to update the application');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App $application
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(App $application)
    {
        if ($application->delete()){
            Session::flash('status', 'Successfully deleted the application');
        }else{
            Session::flash('status', 'Failed to delete the application');
        }
        return redirect()->back();
    }
}
