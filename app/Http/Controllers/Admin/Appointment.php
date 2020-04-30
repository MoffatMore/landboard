<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment as AppointmentDB;

class Appointment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.admin.appointments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $appoint = AppointmentDB::where('date',$request->date)->first();
        if ($appoint){
            return redirect()->back()->with('fail','Failed there is a already scheduled appointment, please change date and time');
        }
        AppointmentDB::create([
            'application_id' => $request->application_id,
            'venue'=>$request->venue,
            'date'=>$request->date,
            'user_id'=>$request->user_id
        ]);
        $app = Application::find($request->application_id);

        $app->update([
            'status' => 'Interview scheduled'
        ]);

        return redirect()->back()->with('status','Successfully scheduled an appointment');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppointmentDB $appointment)
    {
        $appoint = AppointmentDB::where('date',$request->date)->first();
        if ($appoint){
            return redirect()->back()->with('fail','Failed there is a already scheduled appointment, please change date and time');
        }

        $appointment->update($request->all());

        return redirect()->back()->with('status','Successfully updated an appointment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
