<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TRESIDENTBASICINFO;
use Carbon\Carbon;
use DB;
use Session;

class BarangayOfficialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        

    public function index(request $request)
    {
        $brgy_id = session('session_brgy_id');

        // $blottersub = DB::table('r_blotter_subjects')
        //                     ->select('blotter_subject_id'
        //                         , 'blotter_name') 
        //                     ->where(['active_flag' => '1'])
        //                     ->orderBy('created_at', 'desc')
        //                     ->get();

        $dispOfficials = DB::table('t_barangay_official AS officials')                            
                            ->join('t_resident_basic_info AS resident', 'officials.resident_id', '=', 'resident.resident_id')
                            ->join('r_position AS position', 'position.position_id', '=', 'officials.position_id' )
                            ->select('officials.barangay_official_id'
                                , 'officials.barangay_id'
                                , 'officials.position_id'
                                , 'officials.start_term'
                                , 'officials.end_term'
                                , 'officials.employee_number'
                                , 'officials.email'
                                , 'officials.active_flag'
                                , 'resident.lastname'
                                , 'resident.firstname'
                                , 'position.position_name')
                            ->where(['officials.active_flag' => 1])
                            ->where(['resident.active_flag' => 1])
                            ->where(['position.active_flag' => 1])
                            ->where(['officials.barangay_id' => $brgy_id])
                            ->get();

        $DisplayResidents =  db::select("call sp_residents_not_official()");
        $DisplayBarangayPosition = db::select('call sp_get_positions()');

       
        return view('administration.barangayofficials', compact('dispOfficials', 'DisplayResidents', 'DisplayBarangayPosition'));
     
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $brgy_id = session('session_brgy_id');

        $BarangayOfficialID = db::table('t_barangay_official')->insert(
            [
                'RESIDENT_ID'=> request('residentID'),
                'BARANGAY_ID'=> $brgy_id,
                'POSITION_ID' => request('position'),
                'START_TERM'=> request('startTerm'),
                'END_TERM'=> request('endTerm'),
                'EMPLOYEE_NUMBER' => request('employeeNo'),
                'EMAIL' => request('email'),
                'CREATED_AT' => Carbon::now(),
                'ACTIVE_FLAG' => 1
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\blotters  $blotters
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blotters  $blotters
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $getID = request('blotter_id');
        $status_name = request('status_name');
        $remarks = request('remarks');
        
        
        $resolveBlot=DB::table('t_blotter')
                        ->where('blotter_id',$getID)
                        ->update([ 'resolution'=>request('remarks'), 
                            'status' => $status_name == 1 ? 'Resolved' : 'For Referral', 
                            'closed_date'=>Carbon::today()->toDateString() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blotters  $blotters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $getBlotID = $request->input('EditBlotterID');

        $updateBlotter=DB::table('t_blotter')
                        ->where('blotter_id',$getBlotID)
                        ->update([ 'incident_date'=>$request->input('EditIncidentDate'), 
                            'incident_area' =>$request->input('EditIncidentArea'),
                            'complaint_name' =>$request->input('EditComplainantName'),
                            'accused_resident' =>$request->input('EditAccusedResident'),
                            'blotter_subject_id' =>$request->input('EditBlotterSubject'),
                            'complaint_statement' =>$request->input('EditComplainStatement')
                             ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blotters  $blotters
     * @return \Illuminate\Http\Response
     */
  

    public function remove()
    {
        $blotter_id =  request('blotter_id');

       db::table('t_barangay_official')
            ->where('barangay_official_id', $blotter_id)
            ->update(['ACTIVE_FLAG' => 0]);
        db::table('t_users')
            ->where('barangay_official_id', $blotter_id)
            ->update(['ACTIVE_FLAG' => 0]);
    }
}
