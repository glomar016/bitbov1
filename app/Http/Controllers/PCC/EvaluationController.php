<?php

namespace App\Http\Controllers\PCC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class EvaluationController extends Controller
{
    public function index()
    {

        $businessNotApproved = DB::table('v_official_business_list')->where('STATUS', 'Pending')->get();
        $application_form_resident = DB::table('v_application_form_resident')->where('STATUS', 'Pending')->get();
        $pending_application_form = DB::table('v_pending_application_form')
            ->orderBy('FORM_DATE', 'desc')
            ->get();

        $pending_buildings = DB::table('v_building_application')->where('STATUS', 'Pending')->get();
        $pending_weights_and_measure = DB::table('t_application_form as af')
        ->join('t_weights_and_measure as wm','af.WEIGHTS_AND_MEASURE_ID','wm.WEIGHTS_AND_MEASURE_ID')
        ->join('t_business_information as bi','wm.BUSINESS_ID','bi.BUSINESS_ID')
        ->where('af.STATUS', 'Pending')
        ->get();

        return view('permit_certification_clearance.verification', compact(
            'businessNotApproved',
            'pending_application_form',
            'application_form_resident',
            'pending_buildings',
            'pending_weights_and_measure'
        ));
    }
    // BUSINESS
    public function CRUDBusinessApproval(Request $request)
    {
        $BUSINESS_ID = $request->BUSINESS_ID;
        $STATUS = $request->STATUS;
        $APPROVED_BY = $request->APPROVED_BY;

        $insert = DB::table('t_business_approval')
            ->insert(array(
                'BUSINESS_ID' => $BUSINESS_ID, 'STATUS' => 'Evaluated', 'APPROVED_BY' => $APPROVED_BY, 'DATE_APPROVED' => date('Y-m-d')
            ));

        $updateBusinessStatus = DB::table('t_business_information')
            ->where('BUSINESS_ID', $BUSINESS_ID)
            ->update(array(
                'STATUS' => $STATUS
            ));
    }

    //ISSUANCE
    public function IssuanceEvaluation(Request $request)
    {

        $OR_NO = $request->OR_NO;
        $OR_DATE = $request->OR_DATE;
        $OR_AMOUNT = $request->OR_AMOUNT;
        $FORM_ID = $request->FORM_ID;
        $PAPER_TYPE_ID = $request->PAPER_TYPE_ID;
        $EVALUATED_BY = $request->EVALUATED_BY;
        $EVALUATION_STATUS = $request->EVALUATION_STATUS;
        $REMARKS = $request->REMARKS;
        $BUSINESS_ID = $request->BUSINESS_ID;
        $YEAR_MONTH = $request->YEAR_MONTH;

        // $control = DB::table('r_paper_type')
        // ->where('PAPER_TYPE_ID', $PAPER_TYPE_ID)
        // ->select('PAPER_TYPE_CODE','SERIES')
        // ->first();



        if ($PAPER_TYPE_ID != 14) {
            $query = DB::table('t_application_form_evaluation as ev')
                ->join('t_application_form as af', 'ev.FORM_ID', 'af.FORM_ID')
                ->where('EVALUATION_STATUS', '=', 'Approved')->count() + 1;
        } else {
            // edited by rodel duterte if business permit
            $query = DB::table('t_application_form_evaluation as ev')
                ->join('t_application_form as af', 'ev.FORM_ID', 'af.FORM_ID')
                ->where('REQUESTED_PAPER_TYPE_ID', $PAPER_TYPE_ID)
                ->where('EVALUATION_STATUS', '=', 'Approved')->count() + 1;
        }

        DB::table('t_application_form_evaluation')
            ->insert(array(
                'FORM_ID' => $FORM_ID, 'EVALUATED_BY' => $EVALUATED_BY, 'EVALUATION_STATUS' => $EVALUATION_STATUS, 'DATE_EVALUATED' => date('Y-m-d'), 'REMARKS' => $REMARKS
            ));


        $control_no = "FM-BBP" . "-" . $YEAR_MONTH . "-" . $query;

        $application_form = DB::table('t_application_form')
            ->where('FORM_ID', $FORM_ID)
            ->update(array(
                'STATUS' => $EVALUATION_STATUS, 'UPDATED_AT' => date('Y-m-d')
            ));

        if ($EVALUATION_STATUS == "Approved") {
            $clearance_certification = DB::table('t_clearance_certification')
                ->insert(array(
                    'CONTROL_NO' => $control_no, 'ISSUED_DATE' => date('Y-m-d'), 'OR_NO' => $OR_NO, 'OR_DATE' => $OR_DATE, 'OR_AMOUNT' => $OR_AMOUNT, 'FORM_ID' => $FORM_ID, 'PAPER_TYPE_ID' => $PAPER_TYPE_ID
                ));
        }
    }

    public function getWeightsAndMeasureApplicationForm(Request $request){
        $WEIGHTS_AND_MEASURE_ID = $request->WEIGHTS_AND_MEASURE_ID;

        $pending_weights_and_measure = DB::table('t_application_form as af')
        ->join('t_weights_and_measure as wm','af.WEIGHTS_AND_MEASURE_ID','wm.WEIGHTS_AND_MEASURE_ID')
        ->join('t_business_information as bi','wm.BUSINESS_ID','bi.BUSINESS_ID')
        ->where('af.STATUS', 'Pending')
        ->where('af.WEIGHTS_AND_MEASURE_ID', $WEIGHTS_AND_MEASURE_ID)
        ->get();

        return response()->json(['pending_weights_and_measure' => $pending_weights_and_measure]);
    }

    public function getApprovedWeightsAndMeasureApplicationForm(Request $request){
        $WEIGHTS_AND_MEASURE_ID = $request->WEIGHTS_AND_MEASURE_ID;

        $pending_weights_and_measure = DB::table('t_application_form as af')
        ->join('t_weights_and_measure as wm','af.WEIGHTS_AND_MEASURE_ID','wm.WEIGHTS_AND_MEASURE_ID')
        ->join('t_business_information as bi','wm.BUSINESS_ID','bi.BUSINESS_ID')
        ->join('t_clearance_certification as cc','af.FORM_ID','cc.FORM_ID')
        ->where('af.STATUS', 'Approved')
        ->where('af.WEIGHTS_AND_MEASURE_ID', $WEIGHTS_AND_MEASURE_ID)
        ->where('af.ACTIVE_FLAG', 1)
        ->get();

        return response()->json(['pending_weights_and_measure' => $pending_weights_and_measure]);
    }

    public function updateApproveWeightsAndMeasureApplicationForm(Request $request){
        $WEIGHTS_AND_MEASURE_ID = $request->WEIGHTS_AND_MEASURE_ID;

        $update = DB::table('t_application_form')
            ->where('WEIGHTS_AND_MEASURE_ID', $request->WEIGHTS_AND_MEASURE_ID)
            ->update(array(
                'ACTIVE_FLAG' => 0
                , 'DEACTIVATION_REASON' => $request->REASON
        ));

    }
}
