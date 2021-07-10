<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ListofWeightsAndMeasureController extends Controller
{
    public function index(Request $request)
    {
       	
       	$position_name = \DB::TABLE('r_position')
       				->WHERE('POSITION_NAME', '<>','Admin')
                    ->PLUCK('POSITION_NAME','POSITION_ID');

        $weights_and_measure_list = \DB::table('t_weights_and_measure as wm')
        ->join('t_business_information as bi','wm.BUSINESS_ID','bi.BUSINESS_ID')
        ->get(['wm.NEW_RENEW_STATUS as WM_NEW_RENEW_STATUS', 'wm.CREATED_AT as WM_CREATED_AT', 'wm.ACTIVE_FLAG as WM_ACTIVE_FLAG',
        'wm.ACTIVE_FLAG as WM_ACTIVE_FLAG',
        'wm.*', 'bi.*']);

        $DisplayTable = $this->gettable();


         // dd($DisplayTable);
        return view('queriesreports.listofweightsandmeasure', compact('DisplayTable', 'weights_and_measure_list'));
    }

    public function gettable()
    {
         $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                            WM.DEVICE_TYPE ,
                                            WM.DEVICE_NUMBER ,
                                            WM.CAPACITY ,
                                            WM.NEW_RENEW_STATUS,
                                            WM.CREATED_AT 
                                            FROM `t_weights_and_measure` AS WM       
                                            inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                            "));
         return $DisplayTable;
    }


    public static function filterdisplay()
    {
        try
        {
            $data = request('editcstatus');
            $active = request('editactive');
            $fromdate = request('fromdate');
            $todate = request('todate');  

            
            if ($data == 'All')
            {   
                    if($active != 'All'){
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                                                AND WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                            "));
                        }                       
                    }
                    else{
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                            WM.DEVICE_TYPE ,
                                            WM.DEVICE_NUMBER ,
                                            WM.CAPACITY ,
                                            WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                            WM.CREATED_AT AS WM_CREATED_AT,
                                            WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                            FROM `t_weights_and_measure` AS WM       
                                            inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                            WHERE WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                            "));
                        }
                        
                    }
                    
            }
            else
            {
                if($active != 'All'){
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                                                AND WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                                                AND WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                                                AND WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }                       
                    }
                    else{
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                            WM.DEVICE_TYPE ,
                                            WM.DEVICE_NUMBER ,
                                            WM.CAPACITY ,
                                            WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                            WM.CREATED_AT AS WM_CREATED_AT,
                                            WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                            FROM `t_weights_and_measure` AS WM       
                                            inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                            WHERE WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                                            AND WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }
                        
                    }
                
            }
            
             return response()->json($DisplayTable);
                
            
        }
        catch(\Exception $e)
        {
            return $e;
        }
    	
    }
     // \DB::enableQueryLog(); dd(\DB::getQueryLog());
   
   
    public function filterprint()
    {
            $data = request('editcstatus');
            $active = request('editactive');
            $fromdate = request('fromdate');
            $todate = request('todate');  

            
            if ($data == 'All')
            {   
                    if($active != 'All'){
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                                                AND WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                            "));
                        }                       
                    }
                    else{
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                            WM.DEVICE_TYPE ,
                                            WM.DEVICE_NUMBER ,
                                            WM.CAPACITY ,
                                            WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                            WM.CREATED_AT AS WM_CREATED_AT,
                                            WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                            FROM `t_weights_and_measure` AS WM       
                                            inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                            WHERE WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                            "));
                        }
                        
                    }
                    
            }
            else
            {
                if($active != 'All'){
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                                                AND WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.ACTIVE_FLAG = '".$active."'
                                                AND WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                                                AND WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }                       
                    }
                    else{
                        if($fromdate == "" || $todate == ""){
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                                WM.DEVICE_TYPE ,
                                                WM.DEVICE_NUMBER ,
                                                WM.CAPACITY ,
                                                WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                                WM.CREATED_AT AS WM_CREATED_AT,
                                                WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                                FROM `t_weights_and_measure` AS WM       
                                                inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                                WHERE WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }
                        else{
                            $DisplayTable = COLLECT(\DB::SELECT("SELECT BI.BUSINESS_NAME AS BI_BUSINESS_NAME,
                                            WM.DEVICE_TYPE ,
                                            WM.DEVICE_NUMBER ,
                                            WM.CAPACITY ,
                                            WM.NEW_RENEW_STATUS AS WM_NEW_RENEW_STATUS,
                                            WM.CREATED_AT AS WM_CREATED_AT,
                                            WM.ACTIVE_FLAG AS WM_ACTIVE_FLAG
                                            FROM `t_weights_and_measure` AS WM       
                                            inner join t_business_information BI ON BI.BUSINESS_ID = WM.BUSINESS_ID
                                            WHERE WM.CREATED_AT BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
                                            AND WM.NEW_RENEW_STATUS = '".$data."'
                            "));
                        }
                        
                    }
                
            }


        $view = View('listofweightsandmeasureprintable', compact('DisplayTable'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->stream();
    }
}
