<?php

namespace App\Http\Controllers\PCC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class IssuanceController extends Controller
{
    public function index()
    {
        $approved_application_form = DB::table('v_approved_application_form')
            ->orderBy('FORM_DATE', 'desc')
            ->get();

        $business_nature = DB::table('v_business_nature')->get();
        $application_form_resident = DB::table('v_application_form_resident')->where('STATUS', 'Approved')->orderBy('CREATED_AT', 'desc')
            ->get();

        $approved_buildings = DB::table('v_building_issuance')
            ->orderBy('FORM_DATE', 'desc')
            ->orderBy('CONTROL_NO', 'desc')
            ->get();

        $approved_weights_and_measure = DB::table('t_weights_and_measure as wm')
            ->join('t_business_information as bi','wm.BUSINESS_ID','bi.BUSINESS_ID')
            ->where('wm.EVALUATED', '1')
            ->get();

        return view('permit_certification_clearance.issuance', compact('approved_application_form', 'business_nature', 'application_form_resident', 'approved_buildings', 'approved_weights_and_measure'));
    }

    public function SpecificBusiness(Request $request)
    {

        $FORM_ID = $request->FORM_ID;
        $REQUESTED_PAPER_TYPE = $request->REQUESTED_PAPER_TYPE;

        if ($REQUESTED_PAPER_TYPE == "Barangay Business Permit") {
            $business_permit = DB::table('v_business_permit')
                ->where('FORM_ID', $FORM_ID)
                ->get();

            $line_of_business = Db::table('v_permit_line_of_business')
                ->where('BUSINESS_ID', $business_permit[0]->BUSINESS_ID)
                ->get();

            return response()->json(
                [
                    'business_permit' => $business_permit,
                    'line_of_business' => $line_of_business,
                    'requested_paper_type' => 'Barangay Business Permit'
                ]
            );
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance Building") {
            $business_info = '';
            $barangay_clearance = DB::table('v_for_business_clearances')
                ->where('FORM_ID', $FORM_ID)
                ->get();

            return response()->json([
                'barangay_clearance' => $barangay_clearance, 'requested_paper_type' => 'Barangay Clearance Building'
            ]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance Business") {

            $barangay_clearance = DB::table('v_for_business_clearances')
                ->where('FORM_ID', $FORM_ID)
                ->get();

            $line_of_business = DB::table('v_permit_line_of_business')
                ->where('BUSINESS_ID', $barangay_clearance[0]->BUSINESS_ID)
                ->get();

            $gross_total = DB::table('v_get_gross')
                ->where('BUSINESS_ID', $barangay_clearance[0]->BUSINESS_ID)
                ->orderBy('BUSINESS_ID')->get();


            return response()->json(
                [
                    'barangay_clearance' => $barangay_clearance,
                    'line_of_business' => $line_of_business,
                    'gross_total' => $gross_total,
                    'requested_paper_type' => 'Barangay Clearance Business'
                ]
            );
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance Building (Non-Business)") {

            $barangay_clearance = DB::table('v_building_related')
                ->where('FORM_ID', $FORM_ID)
                ->groupBy('TRANSACTION_ID')
                ->get();

            $building_occupancy = db::select("call sp_get_occupancy(?,?)", [$barangay_clearance[0]->BUILDING_ID,$barangay_clearance[0]->TRANSACTION_ID]);

            return response()->json([
                'barangay_clearance' => $barangay_clearance, 'requested_paper_type' => 'Barangay Clearance Building (Non-Business)', 'building_occupancy' => $building_occupancy
            ]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance Zonal") {
            $barangay_clearance = DB::table('v_barangay_clearance')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['barangay_clearance' => $barangay_clearance, 'requested_paper_type' => 'Barangay Clearance Zonal']);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance Tricycle") {
            $barangay_clearance = DB::table('v_for_business_clearances')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['barangay_clearance' => $barangay_clearance, 'requested_paper_type' => 'Barangay Clearance Tricycle']);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance General Purposes") {
            $barangay_clearance = DB::table('v_barangay_clearance')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['barangay_clearance' => $barangay_clearance, 'requested_paper_type' => 'Barangay Clearance General Purposes']);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Clearance Weights and Measure") {

            $barangay_clearance = DB::table('v_for_business_clearances')
                ->where('FORM_ID', $FORM_ID)
                ->get();

            return response()->json(['barangay_clearance' => $barangay_clearance, 'requested_paper_type' => 'Barangay Clearance Weights and Measure']);
        }
    }

    public function SpecificResident(Request $request)
    {

        $FORM_ID = $request->FORM_ID;
        $REQUESTED_PAPER_TYPE = $request->REQUESTED_PAPER_TYPE;

        if ($REQUESTED_PAPER_TYPE == "Barangay Clearance For Individual") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();

            $deregatory_record = DB::table('v_get_deregatory')
                ->where('RESIDENT_ID', $request->RESIDENT_ID)
                ->get();

            return response()->json(['requested_paper_type' => 'Barangay Clearance For Individual', 'barangay_certificate' => $barangay_certificate, 'deregatory_record' => $deregatory_record]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate Residency") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['requested_paper_type' => 'Barangay Certificate Residency', 'barangay_certificate' => $barangay_certificate]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate Calamity Loan SSS-GSIS") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['requested_paper_type' => 'Barangay Certificate Calamity Loan SSS-GSIS', 'barangay_certificate' => $barangay_certificate]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate Calamity Loan OFW") {

            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();

            return response()->json(['requested_paper_type' => 'Barangay Certificate Calamity Loan OFW', 'barangay_certificate' => $barangay_certificate]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate SPES") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['requested_paper_type' => 'Barangay Certificate SPES', 'barangay_certificate' => $barangay_certificate]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate Solo Parent") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            foreach ($barangay_certificate as $row) {
                $id = $row->CHILD_NAME;
                $id1 = $row->CHILD_NAME_2;
            }
            $child_1 = DB::table('t_resident_basic_info')
                ->where('RESIDENT_ID', $id)
                ->orWhere('RESIDENT_ID', $id1)
                ->get();
            return response()->json(['requested_paper_type' => 'Barangay Certificate Solo Parent', 'barangay_certificate' => $barangay_certificate, 'child' => $child_1]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate Indigency") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['requested_paper_type' => 'Barangay Certificate Indigency', 'barangay_certificate' => $barangay_certificate]);
        } else if ($REQUESTED_PAPER_TYPE == "Barangay Certificate Travel") {
            $barangay_certificate = DB::table('v_barangay_certificate')
                ->where('FORM_ID', $FORM_ID)
                ->get();
            return response()->json(['requested_paper_type' => 'Barangay Certificate Travel', 'barangay_certificate' => $barangay_certificate]);
        }
    }
}
