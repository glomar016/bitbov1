<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Imports\UsersImport;
use App\Exports\ResidentsExport;
use Carbon\Carbon;
use Excel;
use Session;
use File;
use DB;

class ResidentsController extends Controller
{
    public function index(Request $request)
    {
        
        $resident_type = DB::TABLE('r_resident_type AS RT')
                            ->PLUCK('RT.TYPE_NAME','RT.TYPE_ID');
        return view('resident.basicinfo', compact('resident_type')); 
        //$display_data = db::select("call sp_resident_info(?)",['cerv']);
        //dd($display_data);
      
    }

    public function searchresident()
    {
        $searchval = request('searchval');
        $result = db::select('call search_resident(?)', [$searchval]);
       
        echo json_encode([
            ['listofresidents' => $result]
        ]);
    }

    public function searchforaddingmember()
    {
        $searchval = request('searchval');
        $result = db::select('call sp_search_resident_foradding_member(?)', [$searchval]);
       
        echo json_encode([
            ['listofresidents' => $result]
        ]);
    }
    // return view('administration.samplemigrate');
    public function loadresident()
    {                        
      
        $searchval = request('searchval');
        $display_data = db::select("call sp_resident_info(?)",[$searchval]);
        return datatables()->of($display_data)->make(true);
    } 
    public function healthservices() {

    }

    public function export_import_view() {

        return view('resident.export-import');
    }

    public function export($data)
    {   
        $data = Crypt::decrypt($data);
        $variable = json_decode($data,true);
        return Excel::download(new ResidentsExport($variable), 'Residents.xlsx');
    }

    public function migratedata()
    {
        return view('administration.samplemigrate');
    }

    public function import(Request $request) 
    {
        $extension = File::extension($request->file->getClientOriginalName());
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            Excel::import(new UsersImport,request()->file('file'));
            echo "true";
        }
       
    }

    public function edit(Request $request)
    {
        DB::TABLE('t_resident_basic_info')
            ->WHERE('RESIDENT_ID', request('resident_id'))
            ->UPDATE(
                [
                    'LASTNAME' => request ('editlname'),
                    'MIDDLENAME' => request ('editmname'),
                    'FIRSTNAME' => request ('editfname'),
                    'QUALIFIER' => request ('editqname'),
                    'DATE_OF_BIRTH' => request ('editbdate'),
                    
                    'SEX' => request ('editgender'),
                    'CIVIL_STATUS' => request ('editcstatus'),
                    
                    'OCCUPATION' => request ('editoccu'),
                    //'WORK_STATUS' => request ('editwstatus'),
                    //'DATE_STARTED_WORKING' => request ('editstartw'),
                    'CITIZENSHIP' => request ('editcitiz'),
                    'RELATION_TO_HOUSEHOLD_HEAD' => request ('editrhead'),
                    //'DATE_OF_ARRIVAL' => request ('editarrtime'),
                    //'ARRIVAL_STATUS' => request('editastatus'),
                    //'IS_INDIGENOUS' => request ('edit_isinde'),
                    //'CONTACT_NUMBER' => request ('editcontact'),

                    'PLACE_OF_BIRTH' => request ('editpbirth'),
                    
                    'ADDRESS_HOUSE_NO' => request ('edit_houseno'),
                    'ADDRESS_STREET_NO' => request ('edit_street_no'),
                    'ADDRESS_STREET' => request ('edit_street'),
                    //'ADDRESS_PHASE' => request ('edit_hphase'),
                    'ADDRESS_UNIT_NO' => request ('edit_hunitno'),
                    'ADDRESS_SUBDIVISION' => request ('edit_hsubdivision'),
                    'ADDRESS_BUILDING' => request ('edit_hbuilding'),
                    //'EDUCATIONAL_ATTAINMENT' => request ('editeducationatt'),
                    'UPDATED_AT' => DB::RAW('CURRENT_TIMESTAMP')
                ]   
            );

            // if (request('editastatus') != 3) 
            // {
            //     DB::TABLE('T_TRANSIENT_RECORD')
            //     ->WHERE('RESIDENT_ID', request('resident_id'))
            //     ->UPDATE(
            //         [
            //             'NATURALIZED_DATE' => DB::RAW('CURRENT_TIMESTAMP'),
            //             'UPDATED_AT' => DB::RAW('CURRENT_TIMESTAMP')
            //         ]);
            // }
             echo "good";
    }

    public function deactivate()
    {
        DB::TABLE('t_resident_basic_info')
        ->WHERE('RESIDENT_ID', request('resident_id'))
        ->UPDATE([ 'ACTIVE_FLAG' => 0 ]);
        echo "good";
    }

    
    public function rbi_store(Request $request)
    {
        // $multi_rbi_first_name     = strtoupper(request('multi_rbi_first_name'));
        // $multi_rbi_middle_name    = strtoupper(request('multi_rbi_middle_name'));
        // $multi_rbi_last_name      = strtoupper(request('multi_rbi_last_name'));
        // $multi_rbi_qualifier      = strtoupper(request('multi_rbi_qualifier'));

        $multi_rbi_first_name     = request('multi_rbi_first_name');
        $multi_rbi_middle_name    = request('multi_rbi_middle_name');
        $multi_rbi_last_name      = request('multi_rbi_last_name');
        $multi_rbi_qualifier      = request('multi_rbi_qualifier');
        $multi_rbi_sex            = request('multi_rbi_sex');
        $multi_rbi_date_of_birth  = request('multi_rbi_date_of_birth');
        $multi_rbi_age            = request('multi_rbi_age');
        $multi_rbi_place_of_birth = request('multi_rbi_place_of_birth');
        $multi_rbi_civil_status   = request('multi_rbi_civil_status');
        $multi_rbi_homeownership  = request('multi_rbi_homeownership');
        $multi_rbi_lotownership   = request('multi_rbi_lotownership');
        $multi_rbi_houseno        = request('multi_rbi_houseno');
        $multi_rbi_hstreet        = request('multi_rbi_hstreet');
        $multi_rbi_hstreet_no     = request('multi_rbi_hstreet_no');
        $multi_rbi_hbuilding      = request('multi_rbi_hbuilding');
        $multi_rbi_hunitno        = request('multi_rbi_hunitno');
        $multi_rbi_hsubdivision   = request('multi_rbi_hsubdivision');
        $multi_rbi_citizenship    = request('multi_rbi_citizenship');
        $multi_rbi_occupation     = request('multi_rbi_occupation');
        $multi_rbi_rel_to_head    = request('multi_rbi_rel_to_head');
        $multi_rbi_status         = request('multi_rbi_status');
        $multi_rbi_blk            = request('multi_rbi_blk');

        for($i = 0 ;  $i < count($multi_rbi_first_name) ; $i++)
        {
            $check = DB::TABLE('T_RESIDENT_BASIC_INFO')
                     ->where('LASTNAME',$multi_rbi_last_name[$i])
                     ->where('MIDDLENAME',$multi_rbi_middle_name[$i])
                     ->where('FIRSTNAME',$multi_rbi_first_name[$i])
                     ->where('DATE_OF_BIRTH',$multi_rbi_date_of_birth[$i])
                     ->where('SEX',$multi_rbi_sex[$i])
                     ->get();
            if($check->count() > 1)
            {
                return "Existing";
            }
            else{
                $last_id = DB::TABLE('t_household_information')
                ->INSERTGETID(
                    [
                        'HOME_OWNERSHIP' => $multi_rbi_homeownership[$i],
                        'LOT_OWNERSHIP'  => $multi_rbi_lotownership[$i],                                    
                        'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'),
                        'ACTIVE_FLAG' => 1
                    ]
                );
                $check_rbi_if_complete = $multi_rbi_last_name[$i] != '' && $multi_rbi_first_name[$i] != '' && $multi_rbi_middle_name[$i] != '' && $multi_rbi_houseno[$i] != '' &&  $multi_rbi_hstreet[$i] != '' && $multi_rbi_hbuilding[$i] != '' && $multi_rbi_hunitno[$i] != '' &&  $multi_rbi_hsubdivision[$i] != ''       &&  $multi_rbi_date_of_birth[$i] != ''      &&  $multi_rbi_place_of_birth[$i] != ''     && $multi_rbi_sex[$i] != '' && $multi_rbi_civil_status[$i] != '' && $multi_rbi_citizenship[$i] != '' ?  1 : 0 ;
                $res_last_id = DB::TABLE('T_RESIDENT_BASIC_INFO')
                ->INSERTGETID(
                    [
                        'HOUSEHOLD_ID' => $last_id,
                        'LASTNAME' => strtoupper($multi_rbi_last_name[$i]),
                        'MIDDLENAME' => strtoupper($multi_rbi_middle_name[$i]),
                        'FIRSTNAME' => strtoupper($multi_rbi_first_name[$i]),
                        'ADDRESS_HOUSE_NO' => $multi_rbi_houseno[0],
                        'ADDRESS_STREET_NO' => $multi_rbi_hstreet_no[0],
                        'ADDRESS_STREET' => $multi_rbi_hstreet[0],
                        //'ADDRESS_PHASE' => $multi_rbi_hphase[0],
                        'ADDRESS_BUILDING' => $multi_rbi_hbuilding[0],
                        'ADDRESS_UNIT_NO' => $multi_rbi_hunitno[0],
                        'ADDRESS_SUBDIVISION' => $multi_rbi_hsubdivision[0],

                        'QUALIFIER' => $multi_rbi_qualifier[$i],
                        'DATE_OF_BIRTH' => $multi_rbi_date_of_birth[$i],
                        'PLACE_OF_BIRTH' => $multi_rbi_place_of_birth[$i],
                        'SEX' => $multi_rbi_sex[$i],
                        'CIVIL_STATUS' => $multi_rbi_civil_status[$i],
                        'OCCUPATION' => $multi_rbi_occupation[$i],
                        'CITIZENSHIP' => $multi_rbi_citizenship[$i],
                        'IS_RBI_COMPLETE' => $check_rbi_if_complete ,
                        'RELATION_TO_HOUSEHOLD_HEAD' => $multi_rbi_rel_to_head[$i],
                        'BLK_LOT_PHASE' =>  $multi_rbi_blk[$i], 
                        'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'),
                        'ACTIVE_FLAG' => 1
                    ]
                   
                ); 

                //edited by JAR - added a condition for those who are not belong in any group (blank $multi_rbi_status).
                if ($multi_rbi_status[$i] != ""){
                    
                    if ( $multi_rbi_status[$i] == "newborn" ) {
                        DB::TABLE('t_hs_newborn')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    else if ( $multi_rbi_status[$i] == "infant" ) {
                        DB::TABLE('t_hs_infant')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    else if ( $multi_rbi_status[$i] == "child" ) {
                         DB::TABLE('t_hs_child')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    else if ( $multi_rbi_status[$i] == "adolescent" ) {
                        DB::TABLE('t_hs_adolescent')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    else if ( $multi_rbi_status[$i] == "elderly" ) {
                        DB::TABLE('t_hs_elderly')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                }   

                //added by JAR - a lot/housing owner is not automatically considered as household head.
                if ($multi_rbi_rel_to_head[$i] == "Head"){
                    $get_family_header_last_id = DB::table('t_household_batch')
                        ->insertgetid(['CREATED_AT' => Carbon::now(),
                                       'UPDATED_AT' => Carbon::now()]);

                    DB::table('t_household_members')
                        ->insert([
                                    'FAMILY_HEADER_ID' => $get_family_header_last_id,
                                    'RESIDENT_ID'      => $res_last_id,
                                    'CREATED_AT' => Carbon::now()
                                ]);
                }

            }

            echo 'good';

                
        }
    }
    public function store(Request $request)
    {
            //GETTING HOUSEHOLD MEMBERS INFO
            $multi_fname       = request('multi_fname');
            $multi_mname       = request('multi_mname');
            $multi_lname       = request('multi_lname');
            $multi_qualifier   = request('multi_qualifier');
            $multi_poba        = request('multi_poba');
            $multi_doba        = request('multi_doba');
            $multi_doar        = request('multi_doar');
            $multi_ctizi      = request('multi_ctizi');
            $multi_cvstat     = request('multi_cvstat');
            $multi_religion    = request('multi_religion');
            $multi_sex         = request('multi_sex');            
            $multi_educatt    = request('multi_educatt');
            $multi_enstat = request('multi_enstat');
            $multi_school_type = request('multi_school_type');
            $multi_pschool = request('multi_pschool');
            $multi_occupation = request('multi_occupation');
            $multi_monthlyIncome = request('multi_monthlyIncome');
            $multi_incomeStatus = request('multi_incomeStatus');
            $multi_employmentStatus = request('multi_employmentStatus');
            $multi_workplace = request('multi_workplace');
            // $multi_work_status = request('multi_work_status');
            $multi_pdelivery = request('multi_pdelivery');
            $multi_birthAttendant = request('multi_birthAttendant');
            $multi_immunization = request('multi_immunization');
            $multi_healthFacilityVisited = request('multi_healthFacilityVisited');
            $multi_reasonForVisit = request('multi_reasonForVisit');
            $multi_disability = request('multi_disability');
            $multi_soloParent = request('multi_soloParent');
            $multi_isRegisteredSeniorCitizen = request('multi_isRegisteredSeniorCitizen');
            $multi_irv  = request('multi_irv') == null ? 0 : 1;
            $multi_votingPrecinct = request('multi_votingPrecinct');
            $multi_previousResidence = request('multi_previousResidence');
            $multi_dsw       = request('multi_dsw');
            // $multi_is_ofw    =  request('multi_is_ofw') == null ? 0 : 1;
            $multi_reltohead   = request('multi_reltohead');
            $multi_contactc    = request('multi_contactc');
            $multi_typer       = request('multi_typer');
            $multim            = request('multim');
            $multirc           = request('multirc');
            $multi_p_enddate   = request('multi_p_enddate');
            $multi_migrants    = request('multi_migrants');
            $multi_fromwhat    = request('multi_fromwhat');
            $multi_res         = request('multi_res');
            $multistatus       = request('multistatus');
            $status            = request('status');

            //MARITAL STATUS OF THE HEAD
            $mar_status        = request('mar_status');
            $arrivalStatus     = request('arrivalreason');

            //INSERT FOR HOUSEHOLD INFO
            $household_id = DB::TABLE('t_household_information')
                ->INSERTGETID(
                    [
                        'HOME_OWNERSHIP' => request ('homeownership'),
                        'HOME_MATERIALS' => request ('buildmaterial'),
                        'NUMBER_OF_ROOMS' => request ('numberofrooms'),
                        //'STREET_ADDRESS' => request ('streetno'),
                        'TOILET_HOME' => request ('toilet') ,
                        'PLAY_AREA_HOME' => request ('playarea'),
                        'BEDROOM_HOME' => request ('bedroom'),
                        'DINING_ROOM_HOME' => request ('dining'),
                        'SALA_HOME' => request ('sala'),
                        'KITCHEN_HOME' => request ('kitchen'),
                        'WATER_UTILITIES' => request ('runningwater'),
                        'ELECTRICITY_UTILITIES' => request ('electricity'),
                        'AIRCON_UTILITIES' => request ('aircon'),
                        'PHONE_UTILITIES' => request ('mobile'),
                        'COMPUTER_UTILITIES' => request ('computer'),
                        'INTERNET_UTILITIES' => request ('internet'),
                        'TV_UTILITIES' => request ('boxtv'),
                        'CD_PLAYER_UTILITIES' => request ('cdplayer'),
                        'RADIO_UTILITIES' => request ('boxradio'),
                        'COMICS_ENTERTAINMENT' => request ('comics'),
                        'NEWS_PAPER_ENTERTAINMENT' => request ('newspaper'),
                        'PETS_ENTERTAINMENT' => request ('pets'),
                        'BOOKS_ENTERTAINMENT' => request ('books'),
                        'STORY_BOOKS_ENTERTAINMENT' => request ('storybooks'),
                        'TOYS_ENTERTAINMENT' => request ('toys'),
                        'BOARD_GAMES_ENTERTAINMENT' => request ('boardgames'),
                        'PUZZLES_ENTERTAINMENT' => request ('puzzles'),
                        'PERSON_STAYING_IN_HOUSEHOLD' => request ('personinhousehold'),
                        
                        'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'),
                        'ACTIVE_FLAG' => 1
                    ]
                );
               
                //INSERT FOR RESIDENT-HEAD
                $res_last_id = DB::TABLE('t_resident_basic_info')
                ->INSERTGETID(
                    [
                        'HOUSEHOLD_ID' => $household_id,
                        'LASTNAME' => strtoupper(request('lastname')),
                        'MIDDLENAME' => strtoupper(request('middlename')),
                        'FIRSTNAME' => strtoupper(request ('firstname')),
                        'QUALIFIER' => strtoupper(request ('qualifier')),
                        'ADDRESS_HOUSE_NO' => request('houseno'),
                        'ADDRESS_STREET' => request('hstreet'),
                        'ADDRESS_PHASE' => request('hphase'),
                        'ADDRESS_BUILDING' => request('hbuilding'),
                        'ADDRESS_UNIT_NO' => request('hunitno'),
                        'ADDRESS_SUBDIVISION' => request('hsubdivision'),
                        'QUALIFIER' => request ('qualifier'),
                        'DATE_OF_BIRTH' => request ('dateofbirth'),
                        'PLACE_OF_BIRTH' => request ('placeofbirth'),
                        'SEX' => request ('sex_gender'),
                        'CIVIL_STATUS' => request ('civilstatus'),
                        // 'IS_OFW' => request ('is_ofw'),
                        'OCCUPATION' => request ('occupation'),
                        'MONTHLY_INCOME' => request('monthlyIncome'),
                        'INCOME_STATUS' => request('incomeStatus'),
                        'EMPLOYMENT_STATUS' => request('employmentStatus'),
                        'PLACE_OF_WORK' => request('workplace'),
                        // 'WORK_STATUS' => request ('workstatus'),
                        'RELATION_TO_HOUSEHOLD_HEAD' => request ('relationtohead'),
                        'DATE_OF_ARRIVAL' => request ('dateofarrive'),
                        'ARRIVAL_STATUS' => $arrivalStatus,
                        'FROM_WHAT_COUNTRY' => request('fromwhat'),
                        // 'IS_INDIGENOUS' => request ('is_indegenous'),
                        'ETHNICITY' => request('ethnicity'),
                        'CONTACT_NUMBER' => request ('contactnumber'),
                        'EDUCATIONAL_ATTAINMENT' => request ('educationatt'),
                        'ENROLLMENT_STATUS' => request('enrollment_status'),
                        'SCHOOL_TYPE' => request('school_type'),
                        'PLACE_OF_DELIVERY' => request('pdelivery'),
                        'BIRTH_ATTENDANT' => request('battendant'),
                        'IMMUNIZATION' => request('bimmunization'),
                        'HEALTH_FACILITY_VISITED_LAST_SIX_MONTHS' => request('fvisited'),
                        'REASONFOR_VISIT' => request('rvisit'),
                        'DISABILITY' => request('disability'),
                        'SOLO_PARENT' => request('soloParent'),
                        'IS_REGISTERED_SENIOR_CITIZEN'  => request('isRegisteredSeniorCitizen'),
                        'IS_REGISTERED_VOTER' => request('is_registered_voter'),
                        'VOTING_PRECINCT' => request('votingPrecinct'),
                        'PREVIOUS_RESIDENCE' => request('previousResidence'),
                        'PLACE_OF_SCHOOL' => request('pschool'),
                        'RELIGION' => request('religion'),
                        'LOT_OWNERSHIP' => request('lotownership'),
                        'TYPE_OF_DOCUMENT' => request('typeofdocument'),
                        // 'ISSUED_DATE' => request('wctcissued'),
                        'WHERE_DOCUMENT_ISSUED' => request('wherectcissued'),
                        'RELATION_TO_HOUSEHOLD_HEAD' => "Head",
                        'SKILLS_DEVELOPMENT_TRAINING' => request('sdtraining'),

                        'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'),
                        'ACTIVE_FLAG' => 1
                    ]
                   
                ); 


                    if ( strtolower($mar_status) == "father") {
                        DB::TABLE('t_fathers_profile')->INSERT(['RESIDENT_ID' => $res_last_id, 'FATHER_EDUCATIONAL_ATTAINMENT' => request ('educationatt'),'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'), 'ACTIVE_FLAG' => 1]);
                    }
                    else
                    if ( strtolower($mar_status) == "mother") {
                        DB::TABLE('t_mothers_profile')->INSERT(['RESIDENT_ID' => $res_last_id, 'MOTHER_EDUCATIONAL_ATTAINMENT' => request ('educationatt'),'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'), 'ACTIVE_FLAG' => 1]);
                    }
                    

                    if ( $status == "newborn" ) {
                        DB::TABLE('t_hs_newborn')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    
                    if ( $status == "infant" ) {
                        DB::TABLE('t_hs_infant')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                                 
                    if ( $status == "child" ) {
                        DB::TABLE('t_hs_child')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                        DB::TABLE('t_children_profile')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                           
                    if ( $status == "adolescent" ) {
                        DB::TABLE('t_hs_adolescent')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    
                    if ( $status == "elderly" ) {
                        DB::TABLE('t_hs_elderly')->INSERT(['RESIDENT_ID' => $res_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }

                    $get_family_header_last_id = DB::table('t_household_batch')
                                                ->insertgetid(['CREATED_AT' => DB::raw('current_timestamp'),
                                                               'UPDATED_AT' => DB::raw('current_timestamp')]);
                    DB::table('t_household_members')
                        ->insert([
                                    'FAMILY_HEADER_ID' => $get_family_header_last_id,
                                    'RESIDENT_ID'      => $res_last_id,
                                    'CREATED_AT' => DB::raw('current_timestamp')
                                ]);
               
                $maxhousehold = db::table('t_household_information')->MAX('HOUSEHOLD_ID');


                //INSERT FOR RESIDENTS-HOUSEHOLD MEMBERS
                for($i=0; $i < count($multi_doba); $i++)
                {


                
                    $res_multi_last_id = DB::TABLE('t_resident_basic_info')
                    ->INSERTGETID(
                                    [   
                                        'HOUSEHOLD_ID'                  => $household_id,
                                        'LASTNAME'                      => strtoupper($multi_lname[$i]),
                                        'MIDDLENAME'                    => strtoupper($multi_mname[$i]),
                                        'FIRSTNAME'                     => strtoupper($multi_fname[$i]),
                                        'QUALIFIER'                     => strtoupper($multi_qualifier[$i]),
                                        'ADDRESS_HOUSE_NO'              => request('houseno'),
                                        'ADDRESS_STREET'                => request('hstreet'),
                                        'ADDRESS_PHASE'                 => request('hphase'),
                                        'ADDRESS_BUILDING'              => request('hbuilding'),
                                        'ADDRESS_UNIT_NO'               => request('hunitno'),
                                        'ADDRESS_SUBDIVISION'           => request('hsubdivision'),
                                        'QUALIFIER'                     => request ('qualifier'),
                                        'FROM_WHAT_COUNTRY'             => $multi_fromwhat[$i],
                                        'DATE_OF_BIRTH'                 => $multi_doba[$i],
                                        'PLACE_OF_BIRTH'                => $multi_poba[$i],
                                        'SEX'                           => $multi_sex[$i],
                                        'CIVIL_STATUS'                  => $multi_cvstat[$i],
                                        'RELIGION'                      => $multi_religion[$i],
                                        // 'IS_OFW'                        => $multi_is_ofw[$i],
                                        'OCCUPATION'                    => $multi_occupation[$i],
                                        'MONTHLY_INCOME'                => $multi_monthlyIncome[$i],
                                        'INCOME_STATUS'                 => $multi_incomeStatus[$i],
                                        'EMPLOYMENT_STATUS'             => $multi_employmentStatus[$i],
                                        'PLACE_OF_WORK'                 => $multi_workplace[$i],
                                        'PLACE_OF_DELIVERY'             => $multi_pdelivery[$i],
                                        'BIRTH_ATTENDANT'               => $multi_birthAttendant[$i],
                                        'IMMUNIZATION'                  => $multi_immunization[$i],
                                        'HEALTH_FACILITY_VISITED_LAST_SIX_MONTHS' => $multi_healthFacilityVisited[$i],
                                        'REASONFOR_VISIT'               => $multi_reasonForVisit[$i],
                                        'DISABILITY'                    => $multi_disability[$i],
                                        'SOLO_PARENT'                   => $multi_soloParent[$i],
                                        'IS_REGISTERED_SENIOR_CITIZEN'  => $multi_isRegisteredSeniorCitizen[$i],
                                        'IS_REGISTERED_VOTER'           => $multi_irv[$i],
                                        'VOTING_PRECINCT'               => $multi_votingPrecinct[$i],
                                        'PREVIOUS_RESIDENCE'            => $multi_previousResidence[$i],
                                        // 'WORK_STATUS'                   => $multi_work_status[$i],
                                        // 'DATE_STARTED_WORKING'          => $multi_dsw[$i],
                                        'CITIZENSHIP'                   => $multi_ctizi[$i],
                                        'RELATION_TO_HOUSEHOLD_HEAD'    => $multi_reltohead[$i],
                                        'DATE_OF_ARRIVAL'               => $multi_doar[$i],
                                        'ARRIVAL_STATUS'                => $multirc[$i],
                                        // 'IS_INDIGENOUS'                 => request ('is_indegenous'),
                                        'ETHNICITY'                     => request('ethnicity'),
                                        'CONTACT_NUMBER'                => $multi_contactc[$i],
                                        'EDUCATIONAL_ATTAINMENT'        => $multi_educatt[$i],
                                        'ENROLLMENT_STATUS'             => $multi_enstat[$i],
                                        'SCHOOL_TYPE'                   => $multi_school_type[$i],
                                        'PLACE_OF_SCHOOL'               => $multi_pschool[$i],
                                        'CREATED_AT'                    => DB::RAW('CURRENT_TIMESTAMP'),
                                        'ACTIVE_FLAG'                   => 1
                                    ]               
                            );

                    if ( strtolower($multi_res[$i]) == "father") {
                        DB::TABLE('t_fathers_profile')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'FATHER_EDUCATIONAL_ATTAINMENT' => $multi_educatt[$i],'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'), 'ACTIVE_FLAG' => 1]);
                    }
                    
                    if ( strtolower($multi_res[$i]) == "mother") {
                        DB::TABLE('t_mothers_profile')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'MOTHER_EDUCATIONAL_ATTAINMENT' => $multi_educatt[$i], 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP'), 'ACTIVE_FLAG' => 1]);
                    }

                    if ( $multistatus[$i] == "newborn" ) {
                        DB::TABLE('t_hs_newborn')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    
                    if ( $multistatus[$i] == "infant" ) {
                        DB::TABLE('t_hs_infant')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                                 
                    if ( $multistatus[$i] == "child" ) {
                        DB::TABLE('t_hs_child')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                        DB::TABLE('t_children_profile')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                           
                    if ( $multistatus[$i] == "adolescent" ) {
                        DB::TABLE('t_hs_adolescent')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    }
                    
                    if ( $multistatus[$i] == "elderly" ) {
                        DB::TABLE('t_hs_elderly')->INSERT(['RESIDENT_ID' => $res_multi_last_id, 'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')]);
                    } 


                DB::table('t_household_members')
                    ->insert([
                                'FAMILY_HEADER_ID' => $get_family_header_last_id,
                                'RESIDENT_ID'      => $res_multi_last_id,
                                'CREATED_AT' => DB::raw('current_timestamp')
                            ]);
                   
            }
           
            echo "good";
        
          // if (request('arrivalreason') == 3) 
          //   {
          //       DB::TABLE('T_TRANSIENT_RECORD')
          //       ->INSERT(
          //           [
          //               'RESIDENT_ID' => $res_last_id,
          //               'REASON_FOR_COMING' => request('r_coming'),
          //               'PERIOD_OF_STAY_START_DATE' => request('p_startdate'),
          //               'PERIOD_OF_STAY_END_DATE' => request('p_enddate'),
          //               'CREATED_AT' => DB::RAW('CURRENT_TIMESTAMP')
          //           ]);
          //   }
           
    
    }

}


       // //dd($display_data);
       //  return Datatables::of($display_data)->make(true);

        //return datatables()->of($display_data)->make(true);
// $path = $request->file('select_file')->getRealPath();

//                  $data = Excel::load($path)->get();

//                  if($data->count() > 0)
//                  {
//                     foreach($data->toArray() as $key => $value)
//                     {
//                        foreach($value as $row)
//                        {
//                             $insert_data[] = array(
//                              'fname'  => $row['firstname'],
//                              'mname'   => $row['middlename'],
//                              'lname'   => $row['lastname']
//                             );
//                        }
//                     }

//                       if(!empty($insert_data))
//                       {
//                             DB::table('Z_SAMPLE_MIGRATION')->insert($insert_data);
//                       }
//                  }
//                  return back()->with(['success' => 'Excel Data Imported successfully.']);

