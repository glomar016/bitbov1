<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
class CheckupController extends Controller
{
    //
    public function index()
    {


    

      return view('healthservices.checkup');
    }

    public function load_patients(){
      //edited by JAR - completed the parameters.
      $results = db::select('call sp_manage_checkup(?,?,?,?,?,?,?,?,?)',['FETCH',null,null,null,null,null,null,null,null]);

      echo json_encode([
        ['listofpatients' => $results]
    ]);
    }

    public function add_checkup(){
      $patient_id = request('patient_id');
      $cc = request('cc');
      $diagnosis = request('diagnosis');
      $mt = request('mt');
      //edited by JAR - added 'healthInsurace'
      $healthInsurance = request('healthInsurance');
      db::statement('call sp_manage_checkup(?,?,?,?,?,?,?,?,?)',['STORE',null,null,$patient_id,$cc,$diagnosis,$mt,$healthInsurance,Carbon::now()]);

      //edited by JAR - for updating patient status
      $updateStatus = DB::table('t_patient_records')
          ->where('PATIENT_ID', $patient_id)
          ->update(['STATUS' => 'DONE']);

      
    }

    public function search_patient(){
      $searchval = request('searchval');
      //edited by JAR - completed the parameters.
      $results = db::select('call sp_manage_checkup(?,?,?,?,?,?,?,?,?)',['SEARCH',$searchval,null,null,null,null,null,null,null]);

      echo json_encode([
        ['listofpatients' => $results]
    ]);
    }

  
}
