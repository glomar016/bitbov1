<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
class PatientController extends Controller
{
    //
    public function index()
    {


    

      return view('healthservices.patient');
    }

    public function add_patient(){
      $resident_id= request('resident_id');
      $body_temp= request('body_temp');
      $blood_pressure= request('blood_pressure');
      $pulse_rate= request('pulse_rate');
      $respiratory_rate= request('respiratory_rate');
      $weight= request('weight');
      $height= request('height');
      $is_pregnant= request('is_pregnant');
      $lmp= request('lmp');
      $edc= request('edc');
      $edd= request('edd');

      $result = db::statement("call sp_add_patient(?,?,?,?,?,?,?,?,?,?,?)", [$resident_id,$body_temp,$blood_pressure,$pulse_rate,$respiratory_rate,$weight,$height,$is_pregnant,$lmp,$edc,$edd]);

      //check and insert if mother
      if ($is_pregnant == 1){
      //edited by JAR
      // db::select("call sp_manage_checkup(?,?,?)",['CHECK_IF_MOTHER','',$resident_id]);
      $checkMother = DB::Table('t_mothers_profile AS Mother')
                  ->where('Mother.RESIDENT_ID', $resident_id)
                  ->count();

        if ($checkMother == 0){
          $newMother = DB::table('t_mothers_profile')
          ->insert([
            'RESIDENT_ID'=>$resident_id,
            'IS_PREGNANT'=> 1,
            'CREATED_AT'=>Carbon::now()
          ]);
        }
      }
      
    }
}
