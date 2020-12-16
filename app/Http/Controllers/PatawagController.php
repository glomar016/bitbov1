<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TPatawag;
use App\TBlotter;
use Carbon\Carbon;
use DB;

class PatawagController extends Controller
{ 
        public function index(request $request)
    {
        $upstatus = DB::table('t_patawag')
                        ->where('patawag_sched_datetime', '<', Carbon::now())
                        ->update(['status'=> 'Settled', 
                             ]);

        $disppatawag = DB::table('t_patawag AS P')
                            ->join('t_blotter AS B', 'P.blotter_id', '=', 'B.blotter_id')
                            ->select('P.patawag_id'
                                , 'P.patawag_sched_datetime'
                                , 'P.patawag_sched_place'
                                , 'P.status'
                                , 'B.blotter_id'
                                , 'B.blotter_code')
                            ->where(['P.status' => 'Pending'])
                            ->orderBy('P.patawag_sched_datetime', 'desc')
                            ->get();

        return view('cases.pendingSummon', compact('disppatawag'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $date = $request->input('AddScheduledDate');
        $intime = $request->input('AddScheduledTime');
        $time = date("H:i:s", strtotime($intime));
        $datetime = Carbon::createFromTimestamp(strtotime($date . $time));

        $insertPatawag = new TPatawag();

        $insertPatawag->blotter_id = $request->input('EditBlotterIDH');
        $insertPatawag->patawag_sched_datetime = $datetime;
        $insertPatawag->patawag_sched_place = $request->input('addScheduledPlace');

        $insertPatawag->save();

        //  update number of patawag
        $nopatawag = db::table('t_patawag')->where('BLOTTER_ID',$request->input('EditBlotterIDH'))->count();

        $updateno = db::table('t_blotter')
            ->where('BLOTTER_ID', $request->input('EditBlotterIDH'))
            ->update([
                "NO_OF_PATAWAG" => $nopatawag
            ]);
                            
    }

    public function update(Request $request)
    {
        $getPatawagID = $request->input('patawagID');

        $date = $request->input('updateScheduledDate');
        $intime = $request->input('updateScheduledTime');
        $time = date("H:i:s", strtotime($intime));
        $datetime = Carbon::createFromTimestamp(strtotime($date . $time));
        $place = $request->input('updateScheduledPlace');

        $updatePatawag=DB::table('t_patawag')
                        ->where('patawag_id',$getPatawagID)
                        ->update(['patawag_sched_datetime'=>$datetime, 
                            'patawag_sched_place'=>$request->input('updateScheduledPlace')
                             ]);

    }

    public function printSummon(Request $request){
        $getID = $request->input('patawagIDP');
        
        $for_print= DB::table('t_patawag AS P')
                            ->join('t_blotter AS B', 'P.blotter_id', '=', 'B.blotter_id')                            
                            ->select('P.patawag_id'
                                , 'P.patawag_sched_datetime'
                                , 'P.patawag_sched_place'
                                , 'P.status'
                                , 'B.blotter_id'
                                , 'B.blotter_code'
                                , 'B.complaint_name'                                
                                , 'B.Respondent'
                                )
                            ->where(['P.patawag_id' => $getID])
                            ->get();
        
        return response()->json(['for_print' => $for_print]);
    }
}
