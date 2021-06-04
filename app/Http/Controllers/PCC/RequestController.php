<?php

namespace App\Http\Controllers\PCC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class RequestController extends Controller
{
    public function index($typeofview)
    {

        $business_nature = DB::table('v_business_nature')->get();

        if ($typeofview == "RequestPermit") {

            $approved_business = DB::table('v_qualified_for_permit')
                ->where('LINE_OF_BUSINESS_ID', 4)
                ->where('STATUS', 'Approved')
                ->where('EVALUATED', 0)
                ->get();
            $business_nature = DB::table('v_business_nature')->get();

            return view(
                'permit_certification_clearance.permit',
                compact('approved_business', 'business_nature')
            );
        } else if ($typeofview == "RequestCertification") {

            $resident = DB::table('v_resident')->get();
            $child = DB::table('t_resident_basic_info')
                ->join('t_children_profile',  't_resident_basic_info.resident_id', '=', 't_children_profile.RESIDENT_ID')
                ->get();

            return view('permit_certification_clearance.certificate', compact('resident', 'child'));
        } else if ($typeofview == "RequestClearance") {

            $approved_business = DB::table('v_official_business_list')
                ->where('STATUS', 'Approved')
                ->where('LINE_OF_BUSINESS_ID', '!=', 4)
                ->where('EVALUATED', 0)
                ->get();

            return view(
                'permit_certification_clearance.clearance',
                compact('approved_business', 'business_nature')
            );
        } else if ($typeofview == "RequestClearanceNonBusiness") {

            // $buildings = DB::table('t_building_information as BI')
            //             ->where('BI.STATUS','Approved')
            //             ->where('BI.IS_REQUESTED',0)
            //             // ->Where('BI.IS_IMPROVEMENT',1)
            //             ->get();

            $buildings = DB::table('v_building_transactions')
                ->where('T_STATUS', 'Approved')
                ->where('T_IS_REQUESTED', 0)
                ->orderBy('CREATED_AT', 'DESC')->get();

            return view('permit_certification_clearance.clearance_non_business', compact('buildings'));
        }
    }

    public function searchDeregatory(Request $request)
    {
        $respondents = array();
        $final_search = collect();

        $search_fname = \DB::select('call sp_search_detegatory(?)', [$request->firstname]);

        if (empty($search_fname)) {
            $search_mname = \DB::select('call sp_search_detegatory(?)', [$request->middlename]);
            if (empty($search_mname)) {
                $search_lname = \DB::select('call sp_search_detegatory(?)', [$request->lastname]);
                if (!empty($search_lname)) {
                    for ($i = 0; $i < count($search_lname); $i++) {
                        $respondents[$i] = $search_lname[$i]->RESPONDENT;
                    }

                    $final_search = $search_lname;
                }
            } else {
                for ($i = 0; $i < count($search_mname); $i++) {
                    $respondents[$i] = $search_mname[$i]->RESPONDENT;
                }

                $final_search = $search_mname;
            }
        } else {
            for ($i = 0; $i < count($search_fname); $i++) {
                $respondents[$i] = $search_fname[$i]->RESPONDENT;
            }

            $final_search = $search_fname;
        }

        $search_data = collect($final_search);

        return response()->json(['search_data' => $search_data, 'respondents' => $respondents]);
    }

    public function getAllRelative(Request $request)
    {

        $id = 0;

        $family_id = DB::table('t_household_members')
            ->where('RESIDENT_ID', $request->res_id)
            ->get(['family_header_id']);

        foreach ($family_id as $row) {
            $id = $row->family_header_id;
        }

        if ($id == 0) {
            return 0;
        } else {
            $child = \DB::select(
                'call sp_get_dependent(?,?)',
                [
                    $id,
                    $request->res_id

                ]
            );
            return response()->json(['child' => $child]);
        }
    }

    public function CRUDRequestClearance(Request $request)
    {
        // Business Permit
        $TAX_YEAR = $request->TAX_YEAR;
        $QUARTER = $request->QUARTER;
        $BARANGAY_PERMIT = $request->BARANGAY_PERMIT;
        $GARBAGE_FEE = $request->GARBAGE_FEE;
        $SIGNBOARD = $request->SIGNBOARD;
        $CTC = $request->CTC;
        $BUSINESS_TAX = $request->BUSINESS_TAX;
        $B_PLATE_NO = $request->B_PLATE_NO;
        $STICKER = $request->STICKER;
        $PLATE_FEE = $request->PLATE_FEE;
        // Clearance Building - A
        $A_APPLICANT_NAME = $request->A_APPLICANT_NAME;
        $A_CONSTRUCTION_ADDRESS = $request->A_CONSTRUCTION_ADDRESS;
        $A_SCOPE_OF_WORK_NAME = $request->A_SCOPE_OF_WORK_NAME;
        $A_SCOPE_OF_WORK_SPECIFY = $request->A_SCOPE_OF_WORK_SPECIFY;
        $A_PROJECT_LOCATION = $request->A_PROJECT_LOCATION;
        // Clearance Business - B
        $B_REGISTERED_NAME = $request->B_REGISTERED_NAME;
        $B_CONSTRUCTION_ADDRESS = $request->B_CONSTRUCTION_ADDRESS;
        //Clearance Zonal - C
        $C_OCT_TCT_NUMBER = $request->C_OCT_TCT_NUMBER;
        $C_TAX_DECLARATION = $request->C_TAX_DECLARATION;
        $C_BUSINESS_AREA = $request->C_BUSINESS_AREA;
        $C_AREA_CLASSIFICATION = $request->C_AREA_CLASSIFICATION;
        $C_PROJECT_LOCATION = $request->C_PROJECT_LOCATION;
        $C_PURPOSE = $request->C_PURPOSE;
        $C_APPLICANT_NAME = $request->C_APPLICANT_NAME;
        $C_CONSTRUCTION_ADDRESS = $request->C_CONSTRUCTION_ADDRESS;
        //Clearance Tricycle - D
        $D_APPLICANT_NAME = $request->D_APPLICANT_NAME;
        $D_REGISTERED_NAME = $request->D_REGISTERED_NAME;
        $D_CONSTRUCTION_ADDRESS = $request->D_CONSTRUCTION_ADDRESS;
        $D_DRIVER_LICENSE_NO = $request->D_DRIVER_LICENSE_NO;
        $D_MUDGUARD_NO = $request->D_MUDGUARD_NO;
        $D_CR_NO = $request->D_CR_NO;
        $D_OR_NO = $request->D_OR_NO;
        $D_MAKE = $request->D_MAKE;
        $D_PLATE = $request->D_PLATE;
        $D_OR_DATE = $request->D_OR_DATE;
        //Clearance General Purpose - E
        $E_PURPOSE = $request->E_PURPOSE;
        $E_REGISTERED_NAME = $request->E_REGISTERED_NAME;
        $E_CONSTRUCTION_ADDRESS = $request->E_CONSTRUCTION_ADDRESS;
        //General
        $PAPER_TYPE_CLEARANCE = $request->PAPER_TYPE_CLEARANCE;
        $PAPER_TYPE_FORM = $request->PAPER_TYPE_FORM;
        $BUSINESS_ID = $request->BUSINESS_ID;
        $APPLICANT_NAME = $request->APPLICANT_NAME;


        // weight and measures - F
        $F_REGISTERED_NAME = $request->F_REGISTERED_NAME;
        $F_CONSTRUCTION_ADDRESS = $request->F_CONSTRUCTION_ADDRESS;
        $F_LICENSE_NO = $request->F_LICENSE_NO;
        $F_DEVICE_TYPE = $request->F_DEVICE_TYPE;
        $F_CAPACITY = $request->F_CAPACITY;
        $F_SERIAL_NO = $request->F_SERIAL_NO;
        $F_BRAND = $request->F_BRAND;
        $F_MODEL = $request->F_MODEL;
        $F_REGISTRATION_NUMBER = $request->F_REGISTRATION_NUMBER;
        $RESIDENT_ID = $request->RESIDENT_ID;
        // non business
        $PROJECT_TYPE = $request->PROJECT_TYPE;
        $PROJECT_TYPE_OF_OCCUPANCY = $request->PROJECT_TYPE_OF_OCCUPANCY;
        $PROJECT_AREA = $request->PROJECT_AREA;
        $PROJECT_TENURE = $request->PROJECT_TENURE;
        $PROJECT_LAND_USE = $request->PROJECT_LAND_USE;
        $PROJECT_COST = $request->PROJECT_COST;
        $G_APPLICANT_NAME = $request->APPLICANT_NAME;

        $MAIDEN_NAME = $request->MAIDEN_NAME;
        $PURPOSE = $request->PURPOSE;
        $RESIDENT_ID = $request->RESIDENT_ID;
        $BUILDING_ID = $request->BUILDING_ID;
        $TRANSACTION_ID = $request->TRANSACTION_ID;

        $clearance_type_id = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $PAPER_TYPE_CLEARANCE)
            ->select('PAPER_TYPE_ID')
            ->first();

        $form_type_id = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $PAPER_TYPE_CLEARANCE)
            ->select('PAPER_TYPE_ID')
            ->first();

        empty(DB::table('t_application_form')->max('FORM_ID')) ? $latest_form_id = 1
            : $latest_form_id = DB::table('t_application_form')->max('FORM_ID') + 1;

        DB::table('t_business_information')->where('BUSINESS_ID', $BUSINESS_ID)->update(['EVALUATED' => 1]);

        if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance For Individual") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(

                    'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $G_APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'PURPOSE' => $PURPOSE, 'FORM_ID' => $latest_form_id, 'MAIDEN_NAME' => $MAIDEN_NAME

                ));

            return response()->json(['message' => "success"]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Weights and Measure") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'SSSS-SSSS', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));

            $business_permit = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'F_LICENSE_NO' => $F_LICENSE_NO, 'F_DEVICE_TYPE' => $F_DEVICE_TYPE, 'F_BRAND' => $F_BRAND, 'F_MODEL' => $F_MODEL, 'F_CAPACITY' => $F_CAPACITY, 'F_SERIAL_NO' => $F_SERIAL_NO, 'CONSTRUCTION_ADDRESS' => $F_CONSTRUCTION_ADDRESS, 'REGISTERED_NAME' => $F_REGISTERED_NAME, 'F_REGISTRATION_NUMBER' => $F_REGISTRATION_NUMBER, 'FORM_ID' => $latest_form_id

                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Business permit") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'SSSS-SSSS', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));

            $business_permit = DB::table('t_bf_business_permit')
                ->insert(array(
                    'TAX_YEAR' => $TAX_YEAR, 'QUARTER' => $QUARTER, 'BARANGAY_PERMIT' => $BARANGAY_PERMIT, 'GARBAGE_FEE' => $GARBAGE_FEE, 'SIGNBOARD' => $SIGNBOARD, 'CTC' => $CTC, 'BUSINESS_TAX' => $BUSINESS_TAX, 'FORM_ID' => $latest_form_id
                    // ,'PLATE_NO' => $B_PLATE_NO
                    // ,'STICKER' => $STICKER
                    //,'PLATE_FEE' => $PLATE_FEE
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Building") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id

                ));


            $scope_of_work = DB::table('t_bf_scope_of_work')
                ->insert(array(
                    'SCOPE_OF_WORK_NAME' => $A_SCOPE_OF_WORK_NAME, 'SCOPE_OF_WORK_SPECIFY' => $A_SCOPE_OF_WORK_SPECIFY
                ));

            $latest_scope_of_work_id = DB::table('t_bf_scope_of_work')->select('SCOPE_OF_WORK_ID')
                ->latest('SCOPE_OF_WORK_ID')->first();

            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'APPLICANT_NAME' => $A_APPLICANT_NAME, 'CONSTRUCTION_ADDRESS' => $A_CONSTRUCTION_ADDRESS, 'PROJECT_LOCATION' => $A_PROJECT_LOCATION, 'SCOPE_OF_WORK_ID' => $latest_scope_of_work_id->SCOPE_OF_WORK_ID, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Building (Non-Business)") {
            $ID = 0;
            $COL = '';

            if (empty($BUSINESS_ID)) {
                $COL = 'BUILDING_ID';
                $ID = $BUILDING_ID;
            } else {
                $COL = 'BUSINESS_ID';
                $ID = $BUSINESS_ID;
            }
            $FOR_AP_BUILDING_ID = DB::Table('t_building_transactions')->where('TRANSACTION_ID', $BUILDING_ID)->value('BUILDING_ID');
            DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', $COL => $ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $G_APPLICANT_NAME, 'FORM_ID' => $latest_form_id, $COL => $FOR_AP_BUILDING_ID
                    , 'TRANSACTION_ID' => $TRANSACTION_ID
                ));

            DB::Table('t_building_transactions')
                ->where('TRANSACTION_ID', $BUILDING_ID)
                ->update(['T_IS_REQUESTED' => 1]);
            // $scope_of_work = DB::table('t_bf_scope_of_work')
            // ->insert(array(
            //     'SCOPE_OF_WORK_NAME' => $A_SCOPE_OF_WORK_NAME
            //     ,'SCOPE_OF_WORK_SPECIFY' => ''
            // ));

            // $latest_scope_of_work_id = DB::table('t_bf_scope_of_work')
            // ->select('SCOPE_OF_WORK_ID')
            // ->latest('SCOPE_OF_WORK_ID')
            // ->first();

            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'APPLICANT_NAME' => $G_APPLICANT_NAME, 'PURPOSE' => $PURPOSE
                    //,'CONSTRUCTION_ADDRESS' => $A_CONSTRUCTION_ADDRESS
                    //,'PROJECT_LOCATION' => $A_PROJECT_LOCATION
                    //,'SCOPE_OF_WORK_ID' => $latest_scope_of_work_id->SCOPE_OF_WORK_ID
                    , 'FORM_ID' => $latest_form_id
                    //,'PROJECT_TYPE' => $PROJECT_TYPE
                    //,'PROJECT_TYPE_OF_OCCUPANCY' => $PROJECT_TYPE_OF_OCCUPANCY
                    //,'PROJECT_AREA' => $PROJECT_AREA
                    //,'PROJECT_TENURE' => $PROJECT_TENURE
                    , 'PROJECT_LAND_USE' => $PROJECT_LAND_USE
                    //,'PROJECT_COST' => $PROJECT_COST
                ));

            return response()->json(['message' => "success"]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Business") {



            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id

                ));

            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'REGISTERED_NAME' => $B_REGISTERED_NAME, 'CONSTRUCTION_ADDRESS' => $B_CONSTRUCTION_ADDRESS, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Zonal") {



            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id

                ));

            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'OCT_TCT_NUMBER' => $C_OCT_TCT_NUMBER, 'TAX_DECLARATION' => $C_TAX_DECLARATION, 'BUSINESS_AREA' => $C_BUSINESS_AREA, 'AREA_CLASSIFICATION' => $C_AREA_CLASSIFICATION, 'PURPOSE' => $C_PURPOSE, 'APPLICANT_NAME' => $C_APPLICANT_NAME, 'CONSTRUCTION_ADDRESS' => $C_CONSTRUCTION_ADDRESS, 'PROJECT_LOCATION' => $C_PROJECT_LOCATION, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Tricycle") {



            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'FORM_ID' => $latest_form_id
                ));



            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'APPLICANT_NAME' => $D_APPLICANT_NAME, 'REGISTERED_NAME' => $D_REGISTERED_NAME, 'CONSTRUCTION_ADDRESS' => $D_CONSTRUCTION_ADDRESS, 'D_DRIVER_LICENSE_NO' => $D_DRIVER_LICENSE_NO, 'D_MUDGUARD_NO' => $D_MUDGUARD_NO, 'D_CR_NO' => $D_CR_NO, 'D_OR_NO' => $D_OR_NO, 'D_OR_DATE' => $D_OR_DATE, 'FORM_ID' => $latest_form_id, 'MAKE' => $D_MAKE, 'PLATE_NO' => $D_PLATE
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance General Purposes") {


            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id

                ));


            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'PURPOSE' => $E_PURPOSE, 'REGISTERED_NAME' => $E_REGISTERED_NAME, 'CONSTRUCTION_ADDRESS' => $E_CONSTRUCTION_ADDRESS, 'FORM_ID' => $latest_form_id,
                ));

            return response()->json(['message' => $latest_form_id]);
        }
    }

    public function addDeregatory(Request $request)
    {

        empty(DB::table('t_application_form')->max('FORM_ID')) ? $latest_form_id = 1
            : $latest_form_id = DB::table('t_application_form')->max('FORM_ID') + 1;

        DB::table('t_confirm_deregatory')
            ->insert(
                [
                    'BLOTTER_ID' => $request->blot_id,
                    'RESIDENT_ID' => $request->resident_id,
                    'FORM_ID' => $latest_form_id
                ]
            );

        return response()->json(['message' => "success"]);
    }

    public function checkDeragatory(Request $request)
    {

        $count = DB::table('t_confirm_deregatory')->where('BLOTTER_ID', $request->blot_id)->count();
        return response()->json(['count' => $count]);
    }

    public function CRUDRequestCertificate(Request $request)
    {
        //GENERAL
        $CERTIFICATE_TYPE = $request->CERTIFICATE_TYPE;
        $FORM_TYPE = $request->FORM_TYPE;
        $RESIDENT_ID = $request->RESIDENT_ID;
        $APPLICANT_NAME = $request->APPLICANT_NAME;

        // RESIDENCY - A
        $A_PURPOSE = $request->A_PURPOSE;

        // CALAMITY LOAN SSS-GSIS - B
        $B_SSS_NO = $request->B_SSS_NO;
        $B_CALAMITY_NAME = $request->B_CALAMITY_NAME;
        $B_CALAMITY_DATE = $request->B_CALAMITY_DATE;

        // CALAMITY LOAN OFW - C
        $C_SSS_NO = $request->C_SSS_NO;
        $C_CALAMITY_NAME = $request->C_CALAMITY_NAME;
        $C_CALAMITY_DATE = $request->C_CALAMITY_DATE;
        $C_COUNTRY = $request->C_COUNTRY;

        // SOLO PARENT - E
        $E_CATEGORY_SINGLE_PARENT = $request->E_CATEGORY_SINGLE_PARENT;
        $E_REQUESTOR_NAME = $request->E_REQUESTOR_NAME;
        $E_CHILD_NAME = $request->E_CHILD_NAME;
        $E_CHILD_AGE = $request->E_CHILD_AGE;
        $E_IS_PWD = $request->E_IS_PWD;
        $E_CHILD_NAME_2 = $request->E_CHILD_NAME_2;
        $E_CHILD_AGE_2 = $request->E_CHILD_AGE_2;
        $E_IS_PWD_2 = $request->E_IS_PWD_2;

        // INDIGENCY - F
        $F_PURPOSE = $request->F_PURPOSE;
        $YEAR_MONTH = $request->YEAR_MONTH;

        // TRAVEL
        $T_PLACE_DESTINATION = $request->PLACE_DESTINATION;
        $T_DESTINATION_ADDRESS = $request->DESTINATION_ADDRESS;
        $T_TRAVEL_DATE = $request->TRAVEL_DATE;
        $T_RETURN_DATE = $request->RETURN_DATE;
        $T_PURPOSE = $request->PURPOSE;



        $certificate_type_id = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $CERTIFICATE_TYPE)
            ->select('PAPER_TYPE_ID')
            ->first();
        $form_type_id = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $FORM_TYPE)
            ->select('PAPER_TYPE_ID')
            ->first();
        $control = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $FORM_TYPE)
            ->select('PAPER_TYPE_CODE', 'SERIES')
            ->first();


        $form_number = $control->PAPER_TYPE_CODE . "-" . $YEAR_MONTH . "-" . $control->SERIES;
        empty(DB::table('t_application_form')->max('FORM_ID')) ? $latest_form_id = 1
            : $latest_form_id = DB::table('t_application_form')->max('FORM_ID') + 1;


        if ($CERTIFICATE_TYPE == "Barangay Certificate Residency") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => $form_number, 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'PURPOSE' => $A_PURPOSE, 'FORM_ID' => $latest_form_id
                ));
            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        } else if ($CERTIFICATE_TYPE == "Barangay Certificate Travel") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => $form_number, 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'PURPOSE'                =>    $T_PURPOSE, 'PLACE_DESTINATION'     =>    $T_PLACE_DESTINATION, 'DESTINATION_ADDRESS'   =>    $T_DESTINATION_ADDRESS, 'TRAVEL_DATE'           =>    $T_TRAVEL_DATE, 'RETURN_DATE'           =>    $T_RETURN_DATE, 'FORM_ID'               =>    $latest_form_id
                ));
            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        } else if ($CERTIFICATE_TYPE == "Barangay Certificate Calamity Loan SSS-GSIS") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => $form_number, 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'FORM_ID' => $latest_form_id, 'SSS_NO' => $B_SSS_NO, 'CALAMITY_NAME' => $B_CALAMITY_NAME, 'CALAMITY_DATE' => $B_CALAMITY_DATE
                ));

            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        } else if ($CERTIFICATE_TYPE == "Barangay Certificate Calamity Loan OFW") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => $form_number, 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'FORM_ID' => $latest_form_id, 'SSS_NO' => $C_SSS_NO, 'CALAMITY_NAME' => $C_CALAMITY_NAME, 'CALAMITY_DATE' => $C_CALAMITY_DATE, 'COUNTRY' => $C_COUNTRY
                ));

            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        } else if ($CERTIFICATE_TYPE == "Barangay Certificate SPES") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => $form_number, 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));



            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'FORM_ID' => $latest_form_id
                ));
            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        } else if ($CERTIFICATE_TYPE == "Barangay Certificate Solo Parent") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => $form_number, 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));



            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'FORM_ID' => $latest_form_id, 'CATEGORY_SINGLE_PARENT' => $E_CATEGORY_SINGLE_PARENT, 'REQUESTOR_NAME' => $E_REQUESTOR_NAME

                ));

            $latest_barangay_certificate_id = DB::table('t_bf_barangay_certification')->select('BARANGAY_CERTIFICATION_ID')->latest('BARANGAY_CERTIFICATION_ID')->first();

            $solo_parent_children = DB::table('t_solo_parent_children')
                ->insert(array(
                    'BARANGAY_CERTIFICATION_ID' => $latest_barangay_certificate_id->BARANGAY_CERTIFICATION_ID, 'CHILD_NAME' => $E_CHILD_NAME, 'CHILD_AGE' => $E_CHILD_AGE, 'IS_PWD' => $E_IS_PWD, 'CHILD_NAME_2' => $E_CHILD_NAME_2, 'CHILD_AGE_2' => $E_CHILD_AGE_2, 'IS_PWD_2' => $E_IS_PWD_2
                ));

            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        } else if ($CERTIFICATE_TYPE == "Barangay Certificate Indigency") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(

                    'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'RESIDENT_ID' => $RESIDENT_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $certificate_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $barangay_certificate = DB::table('t_bf_barangay_certification')
                ->insert(array(
                    'FORM_ID' => $latest_form_id, 'PURPOSE' => $F_PURPOSE
                ));
            return response()->json(['message' => $certificate_type_id->PAPER_TYPE_ID . ' ' . $form_type_id->PAPER_TYPE_ID]);
        }
    }
    public function lrtrim($string)
    {

        return rtrim(ltrim($string));
    }

    public function BusinessIssuanceRequest(Request $request)
    {
        // Business Permit
        $TAX_YEAR = $request->TAX_YEAR;
        $QUARTER = $request->QUARTER;
        $BARANGAY_PERMIT = $request->BARANGAY_PERMIT;
        $GARBAGE_FEE = $request->GARBAGE_FEE;
        $SIGNBOARD = $request->SIGNBOARD;
        $CTC = $request->CTC;
        $BUSINESS_TAX = $request->BUSINESS_TAX;
        $PLATE_NO = $request->PLATE_NO;
        $STICKER = $request->STICKER;
        $PLATE_FEE = $request->PLATE_FEE;

        // Clearance Building - A
        $A_APPLICANT_NAME = $request->A_APPLICANT_NAME;
        $A_CONSTRUCTION_ADDRESS = $request->A_CONSTRUCTION_ADDRESS;
        $A_SCOPE_OF_WORK_NAME = $request->A_SCOPE_OF_WORK_NAME;
        $A_SCOPE_OF_WORK_SPECIFY = $request->A_SCOPE_OF_WORK_SPECIFY;
        $A_PROJECT_LOCATION = $request->A_PROJECT_LOCATION;
        // Clearance Business - B
        $B_REGISTERED_NAME = $request->B_REGISTERED_NAME;
        $B_CONSTRUCTION_ADDRESS = $request->B_CONSTRUCTION_ADDRESS;
        //Clearance Zonal - C
        $C_OCT_TCT_NUMBER = $request->C_OCT_TCT_NUMBER;
        $C_TAX_DECLARATION = $request->C_TAX_DECLARATION;
        $C_BUSINESS_AREA = $request->C_BUSINESS_AREA;
        $C_AREA_CLASSIFICATION = $request->C_AREA_CLASSIFICATION;
        $C_PROJECT_LOCATION = $request->C_PROJECT_LOCATION;
        $C_PURPOSE = $request->C_PURPOSE;
        $C_APPLICANT_NAME = $request->C_APPLICANT_NAME;
        $C_CONSTRUCTION_ADDRESS = $request->C_CONSTRUCTION_ADDRESS;
        //Clearance Tricycle - D
        $D_APPLICANT_NAME = $request->D_APPLICANT_NAME;
        $D_REGISTERED_NAME = $request->D_REGISTERED_NAME;
        $D_CONSTRUCTION_ADDRESS = $request->D_CONSTRUCTION_ADDRESS;
        $D_DRIVER_LICENSE_NO = $request->D_DRIVER_LICENSE_NO;
        $D_MUDGUARD_NO = $request->D_MUDGUARD_NO;
        $D_CR_NO = $request->D_CR_NO;
        $D_OR_NO = $request->D_OR_NO;
        $D_MAKE = $request->D_MAKE;
        $D_PLATE = $request->D_PLATE;

        //Clearance General Purpose - E
        $E_PURPOSE = $request->E_PURPOSE;
        $E_REGISTERED_NAME = $request->E_REGISTERED_NAME;
        $E_CONSTRUCTION_ADDRESS = $request->E_CONSTRUCTION_ADDRESS;
        //General
        $PAPER_TYPE_CLEARANCE = $request->PAPER_TYPE_CLEARANCE;
        $PAPER_TYPE_FORM = $request->PAPER_TYPE_FORM;
        $BUSINESS_ID = $request->BUSINESS_ID;
        $APPLICANT_NAME = $request->APPLICANT_NAME;



        $clearance_type_id = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $PAPER_TYPE_CLEARANCE)
            ->select('PAPER_TYPE_ID')
            ->first();
        $form_type_id = DB::table('r_paper_type')
            ->where('PAPER_TYPE_NAME', $PAPER_TYPE_FORM)
            ->select('PAPER_TYPE_ID')
            ->first();

        empty(DB::table('t_application_form')->max('FORM_ID')) ? $latest_form_id = 1
            : $latest_form_id = DB::table('t_application_form')->max('FORM_ID') + 1;

        DB::table('t_business_information')->where('BUSINESS_ID', $BUSINESS_ID)->update(['EVALUATED' => 1]);

        if ($PAPER_TYPE_CLEARANCE == "Barangay Business Permit") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'SSS-SSS', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'APPLICANT_NAME' => $APPLICANT_NAME, 'FORM_ID' => $latest_form_id
                ));


            $business_permit = DB::table('t_bf_business_permit')
                ->insert(array(
                    'TAX_YEAR' => $TAX_YEAR, 'QUARTER' => $QUARTER, 'BARANGAY_PERMIT' => $BARANGAY_PERMIT, 'GARBAGE_FEE' => $GARBAGE_FEE, 'SIGNBOARD' => $SIGNBOARD, 'CTC' => $CTC, 'BUSINESS_TAX' => $BUSINESS_TAX, 'FORM_ID' => $latest_form_id, 'PLATE_NO' => $PLATE_NO, 'STICKER' => $STICKER, 'PLATE_FEE' => $PLATE_FEE
                ));

            return response()->json(['message' => $latest_form_id, 'applicant_name' => $APPLICANT_NAME]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Building") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'FORM_ID' => $latest_form_id
                ));


            $scope_of_work = DB::table('t_bf_scope_of_work')
                ->insert(array(
                    'SCOPE_OF_WORK_NAME' => $A_SCOPE_OF_WORK_NAME, 'SCOPE_OF_WORK_SPECIFY' => $A_SCOPE_OF_WORK_SPECIFY
                ));

            $latest_scope_of_work_id = DB::table('t_bf_scope_of_work')->select('SCOPE_OF_WORK_ID')->latest('SCOPE_OF_WORK_ID')->first();

            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'APPLICANT_NAME' => $A_APPLICANT_NAME, 'CONSTRUCTION_ADDRESS' => $A_CONSTRUCTION_ADDRESS, 'PROJECT_LOCATION' => $A_PROJECT_LOCATION, 'SCOPE_OF_WORK_ID' => $latest_scope_of_work_id->SCOPE_OF_WORK_ID, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Business") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'FORM_ID' => $latest_form_id
                ));

            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'REGISTERED_NAME' => $B_REGISTERED_NAME, 'CONSTRUCTION_ADDRESS' => $B_CONSTRUCTION_ADDRESS, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Zonal") {
            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'FORM_ID' => $latest_form_id
                ));



            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'OCT_TCT_NUMBER' => $C_OCT_TCT_NUMBER, 'TAX_DECLARATION' => $C_TAX_DECLARATION, 'BUSINESS_AREA' => $C_BUSINESS_AREA, 'AREA_CLASSIFICATION' => $C_AREA_CLASSIFICATION, 'PURPOSE' => $C_PURPOSE, 'APPLICANT_NAME' => $C_APPLICANT_NAME, 'CONSTRUCTION_ADDRESS' => $C_CONSTRUCTION_ADDRESS, 'PROJECT_LOCATION' => $C_PROJECT_LOCATION, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance Tricycle") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'FORM_ID' => $latest_form_id
                ));


            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'APPLICANT_NAME' => $D_APPLICANT_NAME, 'REGISTERED_NAME' => $D_REGISTERED_NAME, 'CONSTRUCTION_ADDRESS' => $this->lrtrim($D_CONSTRUCTION_ADDRESS), 'D_DRIVER_LICENSE_NO' => $D_DRIVER_LICENSE_NO, 'D_MUDGUARD_NO' => $D_MUDGUARD_NO, 'D_CR_NO' => $D_CR_NO, 'D_OR_NO' => $D_OR_NO, 'FORM_ID' => $latest_form_id, 'MAKE' => $D_MAKE, 'PLATE_NO' => $D_PLATE

                ));

            return response()->json(['message' => $latest_form_id]);
        } else if ($PAPER_TYPE_CLEARANCE == "Barangay Clearance General Purposes") {

            $application_form = DB::Table('t_application_form')
                ->insert(array(
                    'FORM_NUMBER' => 'XXXX-XXX', 'PAPER_TYPE_ID' => $form_type_id->PAPER_TYPE_ID, 'STATUS' => 'Pending', 'BUSINESS_ID' => $BUSINESS_ID, 'RECEIVED_BY' => session('session_full_name'), 'REQUESTED_PAPER_TYPE_ID' => $clearance_type_id->PAPER_TYPE_ID, 'FORM_ID' => $latest_form_id
                ));


            $barangay_clearance = DB::table('t_bf_barangay_clearance')
                ->insert(array(
                    'PURPOSE' => $E_PURPOSE, 'REGISTERED_NAME' => $E_REGISTERED_NAME, 'CONSTRUCTION_ADDRESS' => $E_CONSTRUCTION_ADDRESS, 'FORM_ID' => $latest_form_id
                ));

            return response()->json(['message' => $latest_form_id]);
        }
    }
}
