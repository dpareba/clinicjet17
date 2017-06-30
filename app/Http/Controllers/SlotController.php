<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Clinic;
use Session;
use App\Slot;
use Carbon\Carbon;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //dd($request);
        $this->validate($request,[
            'user'=>'required',
            'slotdate'=>'required'
            ]);

        $slot = new Slot;
        $format = 'd/m/Y';
        $input = $request->slotdate;
        $date = Carbon::createFromFormat($format,$input);
        //$dateadd = Carbon::createFromFormat($format,$input)->addDay(1);
        //dd($input . ' ' . $date);
        
        $slot->slotdate = $date;
        $slot->user_id = $request->user;
        $slot->patient_id = $request->patient_id;
        //dd($date->toDateString());
        //$slots = Slot::where('user_id','=',$request->user)->where('slotdate','>',$date)->where('slotdate','<',$date)->orderBy('token','DESC')->first();
        $slots = Slot::where('user_id','=',$request->user)->where('slotdate','=',$date->toDateString())->orderBy('token','DESC')->first();
        // $slodt = Carbon::createFromFormat($format,$input);
        //$slots = Slot::all();
       //dd($slots);
       //$slotdate = Carbon::createFromTimestamp($)
        if ($slots == null) {
            $slot->token = 1;
        }else{
            $slot->token = $slots->token + 1;
        }
        //return $dt;
        $slot->save();

        Session::flash('message','Success!!');
        Session::flash('text','New Token Number generated successfully!!');
        Session::flash('type','success');
        Session::flash('timer','5000');

        return redirect()->route('patients.index');
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
    public function update(Request $request, $id)
    {
        //
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

    public function assigntoken(Request $request){
        //dd($request);
        $patient = Patient::findOrFail($request->patient_id);
        $clinicid = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first()->id;
        $users = Clinic::find($clinicid)->users->where('doctype','!=','RECEPTIONIST');
        return view('slots.assigntoken')->withPatient($patient)->withUsers($users);
    }
}
