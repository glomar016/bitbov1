<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;
use App\Imports\UsersImport;
use App\Exports\OrdinanceExport;
use Carbon\Carbon;
use Excel;
use Session;
use File;
use db;
class OrdinanceController extends Controller
{
    //
    public function index()
    {
        $barangay_id = session('session_brgy_id');

            $ordinances = COLLECT(\DB::SELECT("SELECT O.ORDINANCE_ID,O.ORDINANCE_AUTHOR,
                                            O.ORDINANCE_TITLE,
                                            O.ORDINANCE_NUMBER
                                            ,O.ORDINANCE_SANCTION,
                                            O.ORDINANCE_REMARKS,
                                            O.ORDINANCE_DESCRIPTION, 
                                            O.ACTIVE_FLAG
                                            ,C.ORDINANCE_CATEGORY_NAME
                                            ,BO.BARANGAY_OFFICIAL_ID, CONCAT(RBI.LASTNAME,' ', RBI.FIRSTNAME, ' ', RBI.MIDDLENAME) AS FULLNAMES
                                            FROM t_ordinance AS O  
                                            INNER JOIN r_ordinance_category AS C
                                            ON C.ORDINANCE_CATEGORY_ID = O.CATEGORY_ID
                                            INNER JOIN t_barangay_official AS BO
                                            ON BO.BARANGAY_OFFICIAL_ID = O.BARANGAY_OFFICIAL_ID
                                            INNER JOIN t_resident_basic_info RBI ON BO.RESIDENT_ID = RBI.RESIDENT_ID
                                            where ORDINANCE_NUMBER IS NOT NULL
                                            and ORDINANCE_TYPE = 'ORDINANCE'
                                            
                                         "));

        $category = \DB::TABLE('r_ordinance_category')
                    ->PLUCK('ORDINANCE_CATEGORY_NAME','ORDINANCE_CATEGORY_ID');


        $assign_official = COLLECT(\DB::SELECT("SELECT BO.BARANGAY_OFFICIAL_ID, CONCAT(RBI.LASTNAME,' ', RBI.FIRSTNAME, ' ', RBI.MIDDLENAME) AS FULLNAME
                            FROM t_barangay_official BO
                            INNER JOIN t_resident_basic_info RBI ON BO.RESIDENT_ID = RBI.RESIDENT_ID
                            WHERE BO.BARANGAY_ID = '$barangay_id'"));
        // $resolutionnumber = COLLECT(\DB::SELECT("select lpad(ORDINANCE_ID,4,'0') as Resolution_Number from t_ordinance"));

                


         //dd($barangay_id);            
        return view('ordinance.ordinance', compact('ordinances','category','assign_official'));
 }

    public function store()
    {

        // $resolutionnumber = COLLECT(\DB::SELECT("select lpad(ORDINANCE_ID,4,'0') as Resolution_Number from t_ordinance"));
        $ordinance_file = request()->file('file');
        $get_id = \DB::TABLE('t_ordinance')
            ->INSERTGETID(
                [
                    'ORDINANCE_TITLE'      => request('title'),
                    'ORDINANCE_DESCRIPTION'=> request('description'),
                    'ORDINANCE_AUTHOR'     => request('author'),
                    'ORDINANCE_SANCTION'   => request('sanction'),
                    'CATEGORY_ID'          => request('category_id'),
                    'ORDINANCE_REMARKS'    => request('remarks'),                    
                    'BARANGAY_OFFICIAL_ID' => request ('assign_official'),
                    'ORDINANCE_NUMBER'     => request ('ordinance_number'),
                    'ORDINANCE_TYPE'      => request ('ordi_type'),
                    'ACTIVE_FLAG' => 1
                ]
            );
            foreach($ordinance_file as $value)
            {   
                \DB::TABLE('t_ordinance_images')
                ->INSERT(
                    [
                        'ORDINANCE_ID'      => $get_id,
                        'FILE_NAME'         => $value->getClientOriginalName(),
                       
                    ]
                );
                $value->move(public_path('ordinances'), $value->getClientOriginalName());  
            }   
            
            echo "good";
    }



    public function update()
    {

        $ordinance_file = request()->file('file');
        $ordinance_id = request('ordinance_id');
            \DB::TABLE('t_ordinance')
            ->where('ORDINANCE_ID',$ordinance_id)
            ->update(
                [
                    'ORDINANCE_TITLE'      => request('title'),
                    'ORDINANCE_DESCRIPTION'=> request('description'),
                    'ORDINANCE_AUTHOR'     => request('author'),
                    'ORDINANCE_SANCTION'   => request('sanction_id'),
                    'CATEGORY_ID'          => request('category_id'),        
                    'ORDINANCE_REMARKS'    => request('remarks'),
                    'BARANGAY_OFFICIAL_ID' => request('assignoff'),
                    'ORDINANCE_NUMBER'     => request('v_ordinance_number'),
                    
                    
                ]
            );          
            foreach($ordinance_file as $value)
            {   
                \DB::TABLE('t_ordinance_images')
                ->INSERT(
                    [
                        'ORDINANCE_ID'      => $ordinance_id,
                        'FILE_NAME'         => $value->getClientOriginalName(),
                       
                    ]
                );
                $value->move(public_path('ordinances'), $value->getClientOriginalName());  
            }   
            
            echo "good";
    }


    public function remove()
    {
       $ordinance_id =  request('ordinance_id');
       \DB::TABLE('t_ordinance')
            ->where('ORDINANCE_ID', $ordinance_id)
            ->update(['ACTIVE_FLAG' => 0]);
                  
    }

    public function activate()
    {
       $ordinance_id =  request('ordinance_id');
       \DB::TABLE('t_ordinance')
            ->where('ORDINANCE_ID', $ordinance_id)
            ->update(['ACTIVE_FLAG' => 1]);
                  
    }

    public function get_images()
    {
       $ordinance_id =  request('ordinance_id');
       $collect_images = \DB::table('t_ordinance_images')
            ->where('ORDINANCE_ID', $ordinance_id)
            ->get();
            
        echo json_encode($collect_images);                  
    }
    public function export()
    {
        //Excel::store(new ResidentsExport, 'users.xlsx');
        return Excel::download(new OrdinanceExport, 'Ordinance.xlsx');
    }

}
