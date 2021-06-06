<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class BusinessController extends Controller
{
    public function index($typeOfView)
    {

        $approved_business = DB::table('v_official_business_list')->get();
        $business_nature = DB::table('v_business_nature')->get();
        $line_of_business = DB::table('v_line_of_business')->get();
        $weights_and_measure = DB::table('t_weights_and_measure')->get();
        $businessNotApproved = DB::table('v_official_business_list')->where('STATUS', 'Pending')->get();
        $buildings = DB::table('v_building_list')
        ->orderBy('CREATED_AT', 'DESC')->get();
        $buildingsNotApproved = DB::table('v_building_transactions')
            ->where('T_STATUS', 'Pending')->orderBy('CREATED_AT', 'DESC')->get();
        $improvements = DB::table('t_building_information as bi')
        ->join('t_building_transactions as bt','bi.BUILDING_ID','bt.BUILDING_ID')
        ->where('T_IS_IMPROVEMENT',1)
        ->get();
        
        if ($typeOfView == "business_registration")
            return view(
                'business.business_registration',
                compact('approved_business', 'business_nature', 'line_of_business')
            );
        else if ($typeOfView == "business_evaluation")
            return view(
                'business.business_evaluation',
                compact('businessNotApproved')
            );
        else if ($typeOfView == "building_registration")
            return view(
                'business.building_registration',
                compact('buildings','improvements')
            );
        else if ($typeOfView == "building_evaluation")
            return view(
                'business.building_evaluation',
                compact('buildingsNotApproved')
            );
        else if ($typeOfView == "weights_and_measure_registration")
            return view(
                'business.weights_and_measure_registration',
                compact('weights_and_measure')
            );
    }
    public function get_occupancy(Request $request)
    {
        
        $occupancy = DB::table('t_building_occupancy as bo')
        ->join('t_building_transactions as bt','bo.TRANSACTION_ID','bt.TRANSACTION_ID')
        ->where('bo.BUILDING_ID', $request->BUILDING_ID)
        ->get();
        
        return response()->json(['occupancy' => $occupancy]);
    }

    public function renew_business(Request $request)
    {
        DB::table('t_business_information')
        ->where('BUSINESS_ID', $request->BUSINESS_ID)
        ->update([
            'BUSINESS_ADDRESS' => $request->BUSINESS_ADDRESS ,
            'BUSINESS_EMAIL_ADD' => $request->BUSINESS_EMAIL_ADD ,
            'BUSINESS_TELEPHONE_NO' => $request->BUSINESS_TELEPHONE_NO ,
            'BUSINESS_MOBILE_NO' => $request->BUSINESS_MOBILE_NO ,
            'BUSINESS_POSTAL_CODE' => $request->BUSINESS_POSTAL_CODE ,
            'BUSINESS_MOBILE_NO' => $request->BUSINESS_MOBILE_NO ,
            'EMERGENCY_CONTACT_PERSON' => $request->EMERGENCY_CONTACT_PERSON ,
            'EMERGENCY_PERSON_CONTACT_NO' => $request->EMERGENCY_PERSON_CONTACT_NO ,
            'EMERGENCY_PERSON_EMAIL_ADD' => $request->EMERGENCY_PERSON_EMAIL_ADD ,
            'NO_MALE_EMPLOYEE' => $request->NO_MALE_EMPLOYEE ,
            'NO_FEMALE_EMPLOYEE' => $request->NO_FEMALE_EMPLOYEE ,
            'NO_MALE_LGU' => $request->NO_MALE_LGU ,
            'NO_FEMALE_LGU' => $request->NO_FEMALE_LGU ,
            'BUSINESS_AREA' => $request ->BUSINESS_AREA ,
            'NEW_RENEW_STATUS' => 'Renew'
        ]);

        
        if (!empty($request->LINE_OF_BUSINESS_ID)) 
        {
            DB::table('t_bf_business_activity')->where('BUSINESS_ID', $request->BUSINESS_ID)->delete();
            for($i=0; $i < count($request->LINE_OF_BUSINESS_ID); $i++)
            {
                DB::table('t_bf_business_activity')
                ->insert([
                    'LINE_OF_BUSINESS_ID' => $request->LINE_OF_BUSINESS_ID[$i]
                    , 'NO_OF_UNITS' => $request->NO_OF_UNITS[$i]
                    , 'CAPITALIZATION' => $request->CAPITALIZATION[$i]
                    , 'GROSS_RECEIPTS_ESSENTIAL' => $request->GROSS_RECEIPTS_ESSENTIAL[$i]
                    , 'GROSS_RECEIPTS_NON_ESSENTIAL' => $request->GROSS_RECEIPTS_NON_ESSENTIAL[$i]
                    , 'BUSINESS_ID' => $request->BUSINESS_ID
                ]);
            }
        }

        return response()->json(['line_of_business' => 'success']);
    }

    public function improvement_building(Request $request)
    {
        $OCCUPANCY = $request->occupancy;
        $NO_OF_STOREY = $request->no_of_storey;
        $NO_OF_UNIT = $request->no_of_unit;
        $UNIT_FLOOR_AREA = $request->unit_f_area;

        DB::table('t_building_information')
            ->where('BUILDING_ID', $request->building_id)
            ->update([
                //'SCOPE_OF_WORK' => $request->scope_of_work,
                'BUILDING_NAME' => $request->building_name,
                'BUILDING_ID_NUMBER' => $request->building_no,
                'LOT_NUMBER' => $request->lot_number,
                'PROJECT_LOT_AREA' => $request->lot_area,
                'PROJECT_FLOOR_AREA' => $request->floor_area,
                'APPLICANT_NAME' => $request->owners_name,
                'APPLICANT_ADDRESS' => $request->owner_address,
                'PROJECT_LOCATION' => $request->project_loc,
                'PROJECT_TYPE' => $request->project_type,
                'PROJECT_COST' => $request->project_cost,
                'LESSOR_NAME' => $request->lessor_name,
                'LESSOR_ADDRESS' => $request->lessor_address,
                'LESSOR_NO' => $request->lessor_phone,
                'LESSOR_EMAIL' => $request->lessor_email,
                'MONTHLY_RENTAL' => $request->lessor_rental,
                'STATUS' => 'Pending',
                'IS_IMPROVEMENT' => 1,
                'IS_REQUESTED' => 0
            ]);

        DB::table('t_building_transactions')
            ->insert([
                'BUILDING_ID' => $request->building_id, 'SCOPE_OF_WORK' => $request->scope_of_work, 'T_STATUS' => 'Pending', 'T_IS_IMPROVEMENT' => 1
            ]);

        if (!empty($OCCUPANCY)) {

            if ($request->scope_of_work == 'Renovation') {
                DB::table('t_building_occupancy')->where('building_id', $request->building_id)->delete();
            }
            // DB::table('t_building_transactions')->max('TRANSACTION_ID') $request->transaction_id_imp 
            DB::table('t_building_occupancy')->where('building_id', $request->building_id)->delete();
            for ($i = 0; $i < count($OCCUPANCY); $i++) {
                DB::table('t_building_occupancy')
                    ->insert([
                        'BUILDING_ID' => $request->building_id, 'OCCUPANCY' => $OCCUPANCY[$i], 'STOREY_NO' => $NO_OF_STOREY[$i], 'UNIT_NO' => $NO_OF_UNIT[$i], 'UNIT_FLOOR_AREA' => $UNIT_FLOOR_AREA[$i], 'TRANSACTION_ID' => DB::table('t_building_transactions')->max('TRANSACTION_ID')
                    ]);
            }
        }

        return response()->json(['line_of_business' => 'success']);
    }

    public function getLineofBusiness()
    {

        $line_of_business = DB::table('v_business_nature')->get();
        return response()->json(['line_of_business' => $line_of_business]);
    }
    
    public function getBusinessNumber()
    {

        $business_number = DB::table('v_official_business_list')->get();
        return response()->json(['business_number' => $business_number]);
    }

    public function getGross(Request $request)
    {
       
        $line_of_business = DB::table('v_business_nature')->get();
        $gross = DB::table('v_business_activity')->where('BUSINESS_ID', $request->business_id)->get();
        $business_info = DB::table('t_business_information')->where('BUSINESS_ID', $request->business_id)->get();
        return response()->json(['gross' => $gross, 'line_of_business' => $line_of_business, 'business_info' => $business_info]);
    }

    public function getNature(Request $request)
    {

        $line_of_business = Db::table('v_permit_line_of_business')
            ->where('BUSINESS_ID', $request->business_id)
            ->get();
        // $line_of_business = DB::table('v_get_line_of_b')->where('BUSINESS_ID',$request->business_id)->get();
        return response()->json(['line_of_business' => $line_of_business]);
    }
    // BUILDING REGISTRATION

    public function CRUDBuildingApplication(Request $request)
    {
        $PROJECT_TYPE = $request->PROJECT_TYPE;
        $BUILDING_NAME = $request->BUILDING_NAME;
        $BUILDING_ID_NUMBER = $request->BUILDING_ID_NUMBER;
        $BUILDING_OCCUPANCY = $request->BUILDING_OCCUPANCY;
        $LAND_USE = $request->LAND_USE;
        $SCOPE_OF_WORK = $request->SCOPE_OF_WORK;

        $APPLICANT_NAME = $request->APPLICANT_NAME;
        $APPLICANT_TELEPHONE_NO = $request->APPLICANT_TELEPHONE_NO;
        $APPLICANT_MOBILE_NO = $request->APPLICANT_MOBILE_NO;
        $APPLICANT_EMAIL = $request->APPLICANT_EMAIL;

        $PROJECT_LOCATION = $request->PROJECT_LOCATION;
        $PROJECT_COST = $request->PROJECT_COST;
        $PROJECT_FLOOR_AREA = $request->PROJECT_FLOOR_AREA;
        $PROJECT_LOT_AREA = $request->PROJECT_LOT_AREA;
        $POSTAL_CODE = $request->POSTAL_CODE;
        $FORM_OWNERSHIP = $request->FORM_OWNERSHIP;
        $ENTERPRISE_NAME = $request->ENTERPRISE_NAME;
        $LESSOR_NAME = $request->LESSOR_NAME;
        $LESSOR_ADDRESS = $request->LESSOR_ADDRESS;
        $LESSOR_NO = $request->LESSOR_NO;
        $LESSOR_EMAIL = $request->LESSOR_EMAIL;
        $MONTHLY_RENTAL = $request->MONTHLY_RENTAL;
        $OCCUPANCY = $request->OCCUPANCY;
        $NO_OF_STOREY = $request->NO_OF_STOREY;
        $NO_OF_UNIT = $request->NO_OF_UNIT;
        $UNIT_FLOOR_AREA = $request->UNIT_FLOOR_AREA;
        $APPLICANT_ADDRESS = $request->APPLICANT_ADDRESS;
        $LOT_NUMBER = $request->LOT_NUMBER;

        $BUILDING_ID = DB::table('t_building_information')
            ->insertgetId([
                'PROJECT_TYPE' => $PROJECT_TYPE,
                'BUILDING_NAME' => $BUILDING_NAME,
                'BUILDING_ID_NUMBER' => $BUILDING_ID_NUMBER,
                'BUILDING_OCCUPANCY' => $BUILDING_OCCUPANCY,
                'LAND_USE' => $LAND_USE,
                'SCOPE_OF_WORK' => $SCOPE_OF_WORK,
                'APPLICANT_NAME' => $APPLICANT_NAME,
                'APPLICANT_TELEPHONE_NO' => $APPLICANT_TELEPHONE_NO,
                'APPLICANT_MOBILE_NO' => $APPLICANT_MOBILE_NO,
                'APPLICANT_EMAIL' => $APPLICANT_EMAIL,
                'PROJECT_LOCATION' => $PROJECT_LOCATION,
                'PROJECT_COST' => $PROJECT_COST,
                'PROJECT_FLOOR_AREA' => $PROJECT_FLOOR_AREA,
                'PROJECT_LOT_AREA' => $PROJECT_LOT_AREA,
                'POSTAL_CODE' => $POSTAL_CODE,
                'FORM_OWNERSHIP' => $FORM_OWNERSHIP,
                'ENTERPRISE_NAME' => $ENTERPRISE_NAME,
                'STATUS' => 'Pending',
                'CREATED_AT' => \DB::RAW("CURRENT_TIMESTAMP"),
                'ACTIVE_FLAG' => 1,
                'LESSOR_NAME' => $LESSOR_NAME,
                'LESSOR_ADDRESS' => $LESSOR_ADDRESS,
                'LESSOR_NO' => $LESSOR_NO,
                'LESSOR_EMAIL' => $LESSOR_EMAIL,
                'MONTHLY_RENTAL' => $MONTHLY_RENTAL,
                'APPLICANT_ADDRESS' => $APPLICANT_ADDRESS,
                'LOT_NUMBER' => $LOT_NUMBER
            ]);

        DB::table('t_building_transactions')
            ->insert([
                'BUILDING_ID' => $BUILDING_ID, 'SCOPE_OF_WORK' => $SCOPE_OF_WORK, 'T_STATUS' => 'Pending'
            ]);

        if (!empty($OCCUPANCY)) {
            for ($i = 0; $i < count($OCCUPANCY); $i++) {
                DB::table('t_building_occupancy')
                    ->insert([
                        'BUILDING_ID' => $BUILDING_ID, 'OCCUPANCY' => $OCCUPANCY[$i], 'STOREY_NO' => $NO_OF_STOREY[$i], 'UNIT_NO' => $NO_OF_UNIT[$i], 'UNIT_FLOOR_AREA' => $UNIT_FLOOR_AREA[$i], 'TRANSACTION_ID' => DB::table('t_building_transactions')->max('TRANSACTION_ID')
                    ]);
            }
        }


        return response()->json(['success' => 'succcess']);
    }


    // REGISTRATION
    public function CRUDBusinessApplication(Request $request)
    {

        $BUSINESS_NAME = $request->BUSINESS_NAME;
        $TRADE_NAME = $request->TRADE_NAME;
        $BUSINESS_NATURE_ID = $request->BUSINESS_NATURE_ID;
        $BUSINESS_OWNER_FIRSTNAME = $request->BUSINESS_OWNER_FIRSTNAME;
        $BUSINESS_OWNER_MIDDLENAME = $request->BUSINESS_OWNER_MIDDLENAME;
        $BUSINESS_OWNER_LASTNAME = $request->BUSINESS_OWNER_LASTNAME;
        $BUSINESS_ADDRESS = $request->BUSINESS_ADDRESS;
        $BUSINESS_OR_NUMBER = $request->BUSINESS_OR_NUMBER;
        $TIN_NO = $request->TIN_NO;
        $DTI_REGISTRATION_NO = $request->DTI_REGISTRATION_NO;
        $DTI_NO_DATE = $request->DTI_NO_DATE;

        $TYPE_OF_BUSINESS = $request->TYPE_OF_BUSINESS;
        $BUSINESS_POSTAL_CODE = $request->BUSINESS_POSTAL_CODE;
        $BUSINESS_EMAIL_ADD = $request->BUSINESS_EMAIL_ADD;
        $BUSINESS_TELEPHONE_NO = $request->BUSINESS_TELEPHONE_NO;
        $BUSINESS_MOBILE_NO = $request->BUSINESS_MOBILE_NO;
        $OWNER_ADDRESS = $request->OWNER_ADDRESS;
        $OWNER_POSTAL_CODE = $request->OWNER_POSTAL_CODE;
        $OWNER_EMAIL_ADD = $request->OWNER_EMAIL_ADD;
        $OWNER_TELEPHONE_NO = $request->OWNER_TELEPHONE_NO;
        $OWNER_MOBILE_NO = $request->OWNER_MOBILE_NO;
        $EMERGENCY_CONTACT_PERSON = $request->EMERGENCY_CONTACT_PERSON;
        $EMERGENCY_PERSON_CONTACT_NO = $request->EMERGENCY_PERSON_CONTACT_NO;
        $EMERGENCY_PERSON_EMAIL_ADD = $request->EMERGENCY_PERSON_EMAIL_ADD;
        $BUSINESS_AREA = $request->BUSINESS_AREA;
        $NO_EMPLOYEE_ESTABLISHMENT = $request->NO_EMPLOYEE_ESTABLISHMENT;
        $NO_EMPLOYEE_LGU = $request->NO_EMPLOYEE_LGU;

        $NO_FEMALE_EMPLOYEE = $request->NO_FEMALE_EMPLOYEE;
        $NO_MALE_EMPLOYEE = $request->NO_MALE_EMPLOYEE;
        $NO_FEMALE_LGU = $request->NO_FEMALE_LGU;
        $NO_MALE_LGU = $request->NO_MALE_LGU;

        $LESSOR_NAME = $request->LESSOR_NAME;
        $LESSOR_ADDRESS = $request->LESSOR_ADDRESS;
        $LESSOR_CONTACT_NO = $request->LESSOR_CONTACT_NO;
        // $LESSOR_TELEPHONE = $request->LESSOR_TELEPHONE;
        // $LESSOR_MOBILE_NO = $request->LESSOR_MOBILE_NO;
        $LESSOR_EMAIL_ADD = $request->LESSOR_EMAIL_ADD;
        $MONTHLY_RENTAL = $request->MONTHLY_RENTAL;
        // $BUSINESS_OR_ACQUIRED_DATE = $request->BUSINESS_OR_ACQUIRED_DATE;
        // $LINE_OF_BUSINESS_ID = $request->LINE_OF_BUSINESS_ID;
        // $NO_OF_UNITS = $request->NO_OF_UNITS;
        // $CAPITALIZATION = $request->CAPITALIZATION;
        // $GROSS_RECEIPTS_ESSENTIAL = $request->GROSS_RECEIPTS_ESSENTIAL;
        // $GROSS_RECEIPTS_NON_ESSENTIAL = $request->GROSS_RECEIPTS_NON_ESSENTIAL;
        // BUSINESS ADDRESS
        $BUILDING_NUMBER = $request->BUILDING_NUMBER;
        $BUILDING_NAME = $request->BUILDING_NAME;
        $UNIT_NO = $request->UNIT_NO;
        $STREET = $request->STREET;
        $SITIO = $request->SITIO;
        $SUBDIVISION = $request->SUBDIVISION;
        // RENEWAL
        $REFERENCED_BUSINESS_ID = $request->REFERENCED_BUSINESS_ID;
        $NEW_RENEW_STATUS = $request->NEW_RENEW_STATUS;
        $BUSINESS_ADRESS = $request->BUSINESS_ADRESS;

        $LINE_OF_BUSINESS_ID = $request->LINE_OF_BUSINESS_ID;
        $NO_OF_UNITS = $request->NO_OF_UNITS;
        $CAPITALIZATION = $request->CAPITALIZATION;
        $GROSS_RECEIPTS_ESSENTIAL = $request->GROSS_RECEIPTS_ESSENTIAL;
        $GROSS_RECEIPTS_NON_ESSENTIAL = $request->GROSS_RECEIPTS_NON_ESSENTIAL;

        $insert = DB::table('t_business_information')
            ->insert(array(
                'BUSINESS_NAME' => $BUSINESS_NAME, 'TRADE_NAME' => $TRADE_NAME, 'BUSINESS_NATURE_ID' => $BUSINESS_NATURE_ID, 'BUSINESS_OWNER_FIRSTNAME' => $BUSINESS_OWNER_FIRSTNAME, 'BUSINESS_OWNER_MIDDLENAME' => $BUSINESS_OWNER_MIDDLENAME, 'BUSINESS_OWNER_LASTNAME' => $BUSINESS_OWNER_LASTNAME, 'BUSINESS_ADDRESS' => $BUSINESS_ADDRESS, 'BUSINESS_OR_NUMBER' => $BUSINESS_OR_NUMBER, 'TIN_NO' => $TIN_NO, 'DTI_REGISTRATION_NO' => $DTI_REGISTRATION_NO, 'DTI_NO_DATE' => $DTI_NO_DATE, 'TYPE_OF_BUSINESS' => $TYPE_OF_BUSINESS, 'BUSINESS_POSTAL_CODE' => $BUSINESS_POSTAL_CODE, 'BUSINESS_EMAIL_ADD' => $BUSINESS_EMAIL_ADD, 'BUSINESS_TELEPHONE_NO' => $BUSINESS_TELEPHONE_NO, 'BUSINESS_MOBILE_NO' => $BUSINESS_MOBILE_NO, 'OWNER_ADDRESS' => $OWNER_ADDRESS, 'OWNER_POSTAL_CODE' => $OWNER_POSTAL_CODE, 'OWNER_EMAIL_ADD' => $OWNER_EMAIL_ADD, 'OWNER_TELEPHONE_NO' => $OWNER_TELEPHONE_NO, 'OWNER_MOBILE_NO' => $OWNER_MOBILE_NO, 'EMERGENCY_CONTACT_PERSON' => $EMERGENCY_CONTACT_PERSON, 'EMERGENCY_PERSON_CONTACT_NO' => $EMERGENCY_PERSON_CONTACT_NO, 'EMERGENCY_PERSON_EMAIL_ADD' => $EMERGENCY_PERSON_EMAIL_ADD, 'BUSINESS_AREA' => $BUSINESS_AREA, 'NO_EMPLOYEE_ESTABLISHMENT' => $NO_EMPLOYEE_ESTABLISHMENT, 'NO_EMPLOYEE_LGU' => $NO_EMPLOYEE_LGU, 'LESSOR_NAME' => $LESSOR_NAME, 'LESSOR_ADDRESS' => $LESSOR_ADDRESS, 'LESSOR_CONTACT_NO' => $LESSOR_CONTACT_NO
                // ,'LESSOR_TELEPHONE' => $LESSOR_TELEPHONE
                // ,'LESSOR_MOBILE_NO' => $LESSOR_MOBILE_NO
                , 'LESSOR_EMAIL_ADD' => $LESSOR_EMAIL_ADD, 'MONTHLY_RENTAL' => $MONTHLY_RENTAL
                // ,'BUSINESS_OR_ACQUIRED_DATE'   => $BUSINESS_OR_ACQUIRED_DATE
                , 'CREATED_AT' => date('Y-m-d'), 'STATUS' => 'Pending', 'BUSINESS_ADDRESS' => $BUSINESS_ADDRESS
                //,'BUILDING_NUMBER' => $BUILDING_NUMBER
                //,'BUILDING_NAME' => $BUILDING_NAME
                //,'UNIT_NO' => $UNIT_NO
                //,'STREET' => $STREET
                // ,'SITIO' => $SITIO
                // ,'SUBDIVISION' => $SUBDIVISION
                , 'REFERENCED_BUSINESS_ID' => $REFERENCED_BUSINESS_ID, 'NEW_RENEW_STATUS' => $NEW_RENEW_STATUS
            ));


        $LASTEST_BUSINESS_ID = DB::table('t_business_information')->select('BUSINESS_ID')->latest('BUSINESS_ID')->first();

        for ($i = 0; $i < count($LINE_OF_BUSINESS_ID); $i++) {

            $inserBusinessActivity = DB::table('t_bf_business_activity')
                ->insert(array(
                    'LINE_OF_BUSINESS_ID' => $LINE_OF_BUSINESS_ID[$i], 'NO_OF_UNITS' => $NO_OF_UNITS[$i], 'CAPITALIZATION' => $CAPITALIZATION[$i], 'GROSS_RECEIPTS_ESSENTIAL' => $GROSS_RECEIPTS_ESSENTIAL[$i], 'GROSS_RECEIPTS_NON_ESSENTIAL' => $GROSS_RECEIPTS_NON_ESSENTIAL[$i], 'BUSINESS_ID' => $LASTEST_BUSINESS_ID->BUSINESS_ID
                ));
        }
    }

    public function SpecificBuilding(Request $request)
    {
        $specific_business = DB::table('t_building_information')
            ->where('BUILDING_ID', $request->BUILDING_ID)
            ->get();
        return response()->json(['specific_business' => $specific_business]);
    }
    public function EditBuilding(Request $request)
    {
        DB::table('t_building_information')
            ->where('BUILDING_ID', $request->BUILDING_ID)
            ->update([
                'LOT_NUMBER' => $request->LOT_NUMBER,
                'BUILDING_ID_NUMBER' => $request->BUILDING_NO,
                'BUILDING_NAME' => $request->BUILDING_NAME,

                'PROJECT_LOT_AREA' => $request->LOT_AREA,
                'PROJECT_FLOOR_AREA' => $request->FLOOR_AREA,
                'PROJECT_LOCATION' => $request->PROJECT_LOCATION,
                'PROJECT_TYPE' => $request->PROJECT_TYPE,
                'PROJECT_COST' => $request->PROJECT_COST,
                'LESSOR_NAME' => $request->LESSOR_NAME,
                'LESSOR_ADDRESS' => $request->LESSOR_ADDRESS,
                'LESSOR_NO' => $request->LESSOR_PHONE,
                'LESSOR_EMAIL' => $request->LESSOR_EMAIL,
                'MONTHLY_RENTAL' => $request->MONTLY_RENTAL,

                'APPLICANT_NAME' => $request->APPLICANT_NAME,
                'APPLICANT_ADDRESS' => $request->APPLICANT_ADDRESS,
                'APPLICANT_TELEPHONE_NO' => $request->APPLICANT_PHONE,
                'APPLICANT_MOBILE_NO' => $request->APPLICANT_MOBILE,
                'APPLICANT_EMAIL' => $request->APPLICANT_EMAIL,
                'POSTAL_CODE' => $request->POSTAL_CODE,
                'ENTERPRISE_NAME' => $request->ENTERPRISE,
                'LAND_USE' => $request->LAND_USE,
                'FORM_OWNERSHIP' => $request->FORM_OWNERSHIP
            ]);

        $OCCUPANCY = $request->occupancy;
        $NO_OF_STOREY = $request->no_of_storey;
        $NO_OF_UNIT = $request->no_of_unit;
        $UNIT_FLOOR_AREA = $request->unit_f_area;

        if (!empty($OCCUPANCY)) 
        {
            DB::table('t_building_occupancy')->where('BUILDING_ID', $request->BUILDING_ID)
            ->delete();
            for ($i = 0; $i < count($OCCUPANCY); $i++) {
                DB::table('t_building_occupancy')
                    ->insert([
                        'BUILDING_ID' => $request->BUILDING_ID, 'OCCUPANCY' => $OCCUPANCY[$i], 'STOREY_NO' => $NO_OF_STOREY[$i], 'UNIT_NO' => $NO_OF_UNIT[$i], 'UNIT_FLOOR_AREA' => $UNIT_FLOOR_AREA[$i], 'TRANSACTION_ID' => $request->TRANSACTION_ID
                    ]);
            }
        }
        return response()->json(['success' => 'success']);
    }
    public function editImprovement(Request $request)
    {
        $OCCUPANCY = $request->occupancy;
        $NO_OF_STOREY = $request->no_of_storey;
        $NO_OF_UNIT = $request->no_of_unit;
        $UNIT_FLOOR_AREA = $request->unit_f_area;

        if (!empty($request->TRANSACTION_ID)) 
        {
            DB::table('t_building_occupancy')->where('TRANSACTION_ID', $request->TRANSACTION_ID)
            ->delete();
            for ($i = 0; $i < count($OCCUPANCY); $i++) {
                DB::table('t_building_occupancy')
                    ->insert([
                        'BUILDING_ID' => $request->BUILDING_ID, 'OCCUPANCY' => $OCCUPANCY[$i], 'STOREY_NO' => $NO_OF_STOREY[$i], 'UNIT_NO' => $NO_OF_UNIT[$i], 'UNIT_FLOOR_AREA' => $UNIT_FLOOR_AREA[$i], 'TRANSACTION_ID' => $request->TRANSACTION_ID
                    ]);
            }
        }
        return response()->json(['success' => 'success']);
    }
    public function SpecificBusiness(Request $request)
    {

        $TYPE = $request->TYPE;
        if ($TYPE == "business") {
            $BUSINESS_ID = $request->BUSINESS_ID;
            $specific_business = DB::table('v_business_information')
                ->where('BUSINESS_ID', $BUSINESS_ID)
                ->get();
        } else if ($TYPE == "building") {
            $BUILDING_ID = $request->BUILDING_ID;
            // $specific_business = DB::table('t_building_information')
            //     ->where('BUILDING_ID', $BUILDING_ID)
            //     ->get();

            $specific_business = DB::table('v_building_transactions')
                ->where('BUILDING_ID', $BUILDING_ID)
                ->get();
        }
        return response()->json(['specific_business' => $specific_business]);
    }




    // EVALUATION
    public function CRUDBusinessApproval(Request $request)
    {

        $BUSINESS_ID = $request->BUSINESS_ID;
        $BUILDING_ID = $request->BUILDING_ID;
        $STATUS = $request->STATUS;
        $APPROVED_BY = $request->APPROVED_BY;
        $TYPE = $request->TYPE;
        $TRANSACTION_ID = $request->TRANSACTION_ID;

        if ($TYPE == "building") {

            // $updateBusinessStatus = DB::table('t_building_information')
            // ->where('BUILDING_ID', $BUILDING_ID)
            // ->update(array(
            //     'STATUS' => $STATUS
            // ));

            DB::table('t_building_transactions')
                ->where('TRANSACTION_ID', $TRANSACTION_ID)
                ->update(array(
                    'T_STATUS' => $STATUS
                ));
        } else if ($TYPE == "business") {

            $updateBusinessStatus = DB::table('t_business_information')
                ->where('BUSINESS_ID', $BUSINESS_ID)
                ->update(array(
                    'STATUS' => $STATUS
                ));
        }

        $insert = DB::table('t_business_approval')
            ->insert(array(
                'BUSINESS_ID' => $BUSINESS_ID, 'BUILDING_ID' => $BUILDING_ID, 'STATUS' => 'Evaluated', 'APPROVED_BY' => $APPROVED_BY, 'DATE_APPROVED' => Carbon::now()->toDateString('Y-m-d')
            ));
    }
}
