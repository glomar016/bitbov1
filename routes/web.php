<?php
/*
|--------------------------------------------------------------------------
| Web ROUTEs
|--------------------------------------------------------------------------
|
| Here is where you can register web ROUTEs for your application. These
| ROUTEs are loaded by the ROUTEServiceProvider within a GROUP which
| contains the "web" middleware GROUP. Now create something great!
|
*/

Route::get('/getBusinessNumber', 'BusinessController@getBusinessNumber')->name('getBusinessNumber');

Route::get('/getLineofBusiness', 'BusinessController@getLineofBusiness')->name('getLineofBusiness');
Route::post('/improvement_building', 'BusinessController@improvement_building')->name('improvement_building');


Route::post('/getGross', 'BusinessController@getGross')->name('getGross');
Route::post('/getNature', 'BusinessController@getNature')->name('getNature');
Route::post('/renew_business', 'BusinessController@renew_business')->name('renew_business');


Route::group(['prefix' => ''], function () {
    Route::POST('/LoginMobile', 'MobileLoginController@signin')
        ->name('LoginMobile');
    Route::POST('/AddResident', 'MobileLoginController@Add_Resident')
        ->name('AddResident');
    ROUTE::POST('/ResidentsSearchMobile', 'MobileLoginController@searchresident')
        ->NAME('ResidentsSearchMobile');
});
Route::post('/getAllRelative', 'PCC\RequestController@getAllRelative')
    ->name('getAllRelative');



Route::post('/searchDeregatory', 'PCC\RequestController@searchDeregatory')
    ->name('searchDeregatory');

Route::post('/addDeregatory', 'PCC\RequestController@addDeregatory')
    ->name('addDeregatory');

Route::post('/checkDeragatory', 'PCC\RequestController@checkDeragatory')
    ->name('checkDeragatory');


Route::get('/Installation', 'InstallationController@index')
    ->name('InstallationV2');

Route::post('/Connect_DB', 'InstallationController@create_db')
    ->name('Connect_DB');
Route::post('/add_barangay_account', 'InstallationController@add_barangay_account')
    ->name('Add_Barangay_Account');
Route::post('/TestConnection', 'InstallationController@test_connection')
    ->name('TestConnection');

Route::group(['' => ''], function () {
    Route::get('/Blotter', 'BlottersController@index')
        ->name('Blotter');
    Route::POST('/AddBlotter', 'BlottersController@store')
        ->name('AddBlotter');
    Route::POST('/ResolvedBlotter', 'BlottersController@edit')
        ->name('ResolvedBlotter');
    Route::POST('/UpdateBlotter', 'BlottersController@update')
        ->name('UpdateBlotter');
    Route::POST('/RemoveBlotter', 'BlottersController@remove')
        ->name('RemoveBlotter');
    Route::POST('/Patawag', 'BlottersController@patawag')
        ->name('Patawag');
    Route::POST('/PrintPatawag', 'PatawagController@printSummon')
        ->name('PrintPatawag');
});
Route::group(['' => ''], function () {
    Route::get('/PendingPatawag', 'PatawagController@index')
        ->name('PendingPatawag');
    Route::POST('/AddPatawag', 'PatawagController@store')
        ->name('AddPatawag');
    Route::POST('/UpdatePatawag', 'PatawagController@update')
        ->name('UpdatePatawag');
});
Route::group(['' => ''], function () {
    Route::get('/ListOfBlotters', 'ListofBlottersController@index')
        ->name('ListOfBlotters');
    Route::post('/ListofBlottersPrint', 'ListofBlottersController@filterprint')
        ->name('ListofBlottersPrint');

    Route::post('/ListofBlottersFilterPrint', 'ListofBlottersController@filterdisplay')
        ->name('ListofBlottersFilterPrint');
});




// LOGIN PAGE
ROUTE::POST('/checkconnection', function () {
    return view('login.checkconnection');
})
    ->NAME('checkconnection');
ROUTE::GET('/', 'Controller@go_to_login_page')
    ->NAME('Login');
ROUTE::GROUP(['prefix' => ''], function () {
    ROUTE::POST('/ForgotPassword', 'UserAccountsController@forgot_password')
        ->NAME('ForgotPassword');
    Route::post('/ChangeDefaultPassword', 'Controller@change_password')->name('ChangeDefaultPassword');
    Route::get('/CheckIfFirstLoggedIn', 'Controller@check_if_first_logged_in')->name('CheckIfFirstLoggedIn');
    ROUTE::GET('/ResetPassword', function () {
        return view('login.forgot_password');
    })
        ->NAME('ResetPassword');
});
ROUTE::GROUP(['prefix' => ''], function () {

    ROUTE::GET('/ResidentsReport', 'ListofResidentsController@index')
        ->NAME('listofresidents');
    ROUTE::POST('/ResidentFilterPrint', 'ListofResidentsController@filterprint')
        ->NAME('ResidentFilterPrint');

    ROUTE::POST('/ResidentsFilter', 'ListofResidentsController@filterdisplay')
        ->NAME('ResidentsFilter');

    ROUTE::POST('/RBIAdd', 'ResidentsController@rbi_store')
        ->NAME('RBIAdd');
});
ROUTE::GROUP(['prefix' => ''], function () {

    ROUTE::GET('/ListofBarangayOfficials', 'ListofBarangayOfficialsController@index')
        ->NAME('ListofBarangayOfficials');
    Route::POST('/RemoveOfficial', 'BlottersController@remove')
        ->name('RemoveBlotter');
    ROUTE::POST('/ListofBarangayOfficialsFilter', 'ListofBarangayOfficialsController@filterdisplay')
        ->NAME('ListofBarangayOfficialsFilter');
    ROUTE::POST('/ListofBarangayOfficialsPrint', 'ListofBarangayOfficialsController@filterprint')
        ->NAME('ListofBarangayOfficialsPrint');
});
ROUTE::GROUP(['prefix' => ''], function () {

    ROUTE::GET('/ListofBusinesses', 'ListofBusinessesController@index')
        ->NAME('ListofBusinesses');
    ROUTE::POST('/ListofBusinessesPrint', 'ListofBusinessesController@filterprint')
        ->NAME('ListofBusinessesPrint');

    ROUTE::POST('/ListofBusinessesFilterPrint', 'ListofBusinessesController@filterdisplay')
        ->NAME('ListofBusinessesFilterPrint');
});
ROUTE::GROUP(['prefix' => ''], function () {

    ROUTE::GET('/LisfofOrdianance', 'ListofOrdinanceController@index')
        ->NAME('LisfofOrdianance');
    ROUTE::POST('/LisfofOrdianancePrint', 'ListofOrdinanceController@filterprint')
        ->NAME('LisfofOrdianancePrint');

    ROUTE::POST('/LisfofOrdiananceFilter', 'ListofOrdinanceController@filterdisplay')
        ->NAME('LisfofOrdiananceFilter');

    ROUTE::GET('/ListofResolution', 'ListofResolutionController@index')
        ->NAME('ListofResolution');
    ROUTE::POST('/ListofResolutionFilter', 'ListofResolutionController@filterdisplay')
        ->NAME('ListofResolutionFilter');
    ROUTE::POST('/ListofResolutionPrint', 'ListofResolutionController@filterprint')
        ->NAME('ListofResolutionPrint');
});

// MAIN PAGE
ROUTE::GROUP(['prefix' => ''], function () {
    ROUTE::GET('/Home', 'DashboardController@index')->NAME('Dashboard');
    ROUTE::POST('/EditAccount', 'UserAccountsController@update_my_account')
        ->NAME('EditAccount');
    ROUTE::POST('/CheckOldPassword', 'UserAccountsController@checkoldpass')
        ->NAME('CheckOldPassword');
    ROUTE::GET('/SignOut', 'UserAccountsController@sign_out')
        ->NAME('SignOut');
    ROUTE::POST('/ChangePassword', 'UserAccountsController@change_password')
        ->NAME('ChangePassword');
});
ROUTE::GET('/main', function () {
    return view('global.main');
})->NAME('main');
ROUTE::GROUP(['prefix' => ''], function () {
    ROUTE::GET('/ExportImport', 'ResidentsController@export_import_view')
        ->NAME('ExportImport');

    ROUTE::GET('/Resident', 'ResidentsController@index')
        ->NAME('Resident');
    ROUTE::get('/LoadResidents', 'ResidentsController@loadresident')
        ->NAME('LoadResidents');

    ROUTE::POST('/BasicInfoAdd', 'ResidentsController@store')
        ->NAME('BasicInfoAdd');
    ROUTE::POST('/BasicInfoEdit', 'ResidentsController@edit')
        ->NAME('BasicInfoEdit');
    ROUTE::POST('/BasicInfoDelete', 'ResidentsController@deactivate')
        ->NAME('BasicInfoDelete');

    ROUTE::GET('/ResidentsExport/{data}', 'ResidentsController@export')
        ->NAME('ResidentsExport');

    ROUTE::POST('/ResidentsImport', 'ResidentsController@import')
        ->NAME('ResidentsImport');

    ROUTE::POST('/ResidentsSearch', 'ResidentsController@searchresident')
        ->NAME('ResidentsSearch');

    ROUTE::POST('/ResidentsSearchAddingMember', 'ResidentsController@searchforaddingmember')
        ->NAME('ResidentsSearchAddingMember');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/HouseholdProfile', 'HouseProfileController@index')
        ->NAME('HouseholdProfile');
    ROUTE::POST('/HouseholdProfileEdit', 'HouseProfileController@edit')
        ->NAME('HouseholdProfileEdit');
    ROUTE::GET('/LoadHousehold', 'HouseProfileController@loadhousehold')
        ->NAME('LoadHousehold');


    ROUTE::GET('/HouseholdMembers/{id}', 'HouseholdMemberController@index')
        ->NAME('HouseholdMembers');

    ROUTE::GET('/ViewRbi/{id}', 'HouseholdMemberController@view_rbi')
        ->NAME('ViewRbi');

    ROUTE::POST('/AddHouseholdMembers', 'HouseholdMemberController@addmember')
        ->NAME('AddHouseholdMemberss');

    ROUTE::GET('/HouseholdList', 'HouseholdMemberController@hh_list')
        ->NAME('HouseholdList');
});

Route::get('/encrypt/{value}', function ($value) {
    return Crypt::encrypt($value);
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/MothersProfile', 'MothersProfileController@index')
        ->NAME('MothersProfile');
    ROUTE::POST('/MothersProfileAdd', 'MothersProfileController@store')
        ->NAME('MothersProfileAdd');
    ROUTE::POST('/MothersProfileEdit', 'MothersProfileController@edit')
        ->NAME('MothersProfileEdit');
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/FathersProfile', 'FathersProfileController@index')
        ->NAME('FathersProfile');
    ROUTE::POST('/FathersProfileAdd', 'FathersProfileController@store')
        ->NAME('FathersProfileAdd');
    ROUTE::POST('/FathersProfileEdit', 'FathersProfileController@edit')
        ->NAME('FathersProfileEdit');
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/ChildrensProfile', 'ChildrenProfileController@index')
        ->NAME('ChildrensProfile');
    ROUTE::POST('/ChildrensProfileAdd', 'ChildrenProfileController@store')
        ->NAME('ChildrensProfileAdd');
    ROUTE::POST('/ChildrensProfileEdit', 'ChildrenProfileController@edit')
        ->NAME('ChildrensProfileEdit');
    ROUTE::GET('/LoadChildren', 'ChildrenProfileController@loadchildren')
        ->NAME('LoadChildren');
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/CommunityProfile', 'CommunityProfileController@index')
        ->NAME('CommunityProfile');
    ROUTE::POST('/CommunityProfileAdd', 'CommunityProfileController@store')
        ->NAME('CommunityProfileAdd');
    ROUTE::POST('/CommunityProfileEdit', 'CommunityProfileController@edit')
        ->NAME('CommunityProfileEdit');
});
ROUTE::GROUP(['prefix' => ''], function () {
    ROUTE::GET('/MigrateData', 'ResidentsController@migratedata')
        ->NAME('MigrateData');

    ROUTE::GET('/Migration', 'MigrationController@index')
        ->NAME('Migration');

    // ROUTE::GET('/Backup', 'BackupController@index')
    //     ->NAME('Backup');

    ROUTE::POST('/ImportResidents', 'MigrationController@import_residents')
        ->NAME('ImportResidents');

    ROUTE::POST('/ImportOrdinances', 'MigrationController@import_ordinances')
        ->NAME('ImportOrdinances');

    ROUTE::POST('/ImportBusinesses', 'MigrationController@import_businesses')
        ->NAME('ImportBusinesses');

    ROUTE::POST('/ImportBlotters', 'MigrationController@import_blotter')
        ->NAME('ImportBlotters');
});
ROUTE::GROUP(['prefix' => ''], function () {
    ROUTE::GET('/BusinessCategory', 'BusinessCategController@index')
        ->NAME('BusinessCategory');
    ROUTE::post('/BusinessCategory', 'BusinessCategController@store');

    ROUTE::post('/BusinessCategoryEdit', 'BusinessCategController@edit')
        ->NAME('BusinessCategoryEdit');
    ROUTE::post('/BusinessCategoryDelete', 'BusinessCategController@delete')
        ->NAME('BusinessCategoryDelete');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/IssuanceCategory', 'IssuanceCategController@index')
        ->NAME('IssuanceCategory');
    ROUTE::post('/IssuanceCategory', 'IssuanceCategController@store')->NAME('IssuanceCategoryStore');
    ROUTE::post('/IssuanceCategoryEdit', 'IssuanceCategController@edit')
        ->NAME('IssuanceCategoryEdit');
    ROUTE::post('/IssuanceCategoryDelete', 'IssuanceCategController@delete')
        ->NAME('IssuanceCategoryDelete');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/OrdinanceCategory', 'OrdinanceCategController@index')
        ->NAME('OrdinanceCategory');
    ROUTE::post('/AddOrdinanceCateg', 'OrdinanceCategController@store')->NAME('AddOrdinanceCateg');
    ROUTE::post('/OrdinanceCategoryEdit', 'OrdinanceCategController@edit')
        ->NAME('OrdinanceCategoryEdit');
    ROUTE::post('/OrdinanceCategoryDelete', 'OrdinanceCategController@delete')
        ->NAME('OrdinanceCategoryDelete');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/BlotterSubjects', 'BlotterCategoryController@index')
        ->NAME('BlotterSubjects');
    ROUTE::post('/BlotterSubjectsAdd', 'BlotterCategoryController@store')
        ->NAME('BlotterSubjectsAdd');
    ROUTE::post('/BlotterSubjectsEdit', 'BlotterCategoryController@edit')
        ->NAME('BlotterSubjectsEdit');
    ROUTE::post('/BlotterSubjectsDelete', 'BlotterCategoryController@delete')
        ->NAME('BlotterSubjectsDelete');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Municipality', 'MunicipalityController@index')
        ->NAME('Municipality');
    ROUTE::post('/MunicipalityStore', 'MunicipalityController@store')
        ->NAME('MunicipalityStore');
    ROUTE::post('/MunicipalityDelete', 'MunicipalityController@destroy')
        ->NAME('MunicipalityDelete');
    ROUTE::post('/MunicipalityUpload', 'MunicipalityController@fileUpload')
        ->NAME('MunicipalityUpload');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/BarangaySetup', 'BarangaysetupController@index')
        ->NAME('BarangaySetup');
    ROUTE::post('/AddBarangay', 'BarangaysetupController@store')
        ->NAME('AddBarangay');
    ROUTE::post('/EditBarangay', 'BarangaysetupController@edit')
        ->NAME('EditBarangay');
    ROUTE::post('/RemoveBarangay', 'BarangaysetupController@remove')
        ->NAME('RemoveBarangay');
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/BarangayOfficials', 'BarangayOfficialsController@index')
        ->NAME('BarangayOfficials');
    ROUTE::post('/AddBarangayOfficial', 'BarangayOfficialsController@store')
        ->NAME('AddBarangayOfficial');
    ROUTE::post('/EditBarangayOfficial', 'BarangayOfficialsController@edit')
        ->NAME('EditBarangayOfficial');
    ROUTE::post('/RemoveBarangayOfficial', 'BarangayOfficialsController@remove')
        ->NAME('RemoveBarangayOfficial');
});

ROUTE::GROUP(['' => ''], function () {

    ROUTE::GET('/UserAccounts', 'UserAccountsController@index')
        ->NAME('UserAccounts');
    ROUTE::post('/AddUser', 'UserAccountsController@store')
        ->NAME('AddUser');
    ROUTE::post('/EditUser', 'UserAccountsController@edit')
        ->NAME('EditUser');
    ROUTE::post('/CheckPermission', 'UserAccountsController@check_permission')
        ->NAME('CheckPermission');
    ROUTE::post('/Signin', 'UserAccountsController@signin')
        ->NAME('Signin');

    ROUTE::post('/SetAccountStatus', 'UserAccountsController@set_account_status')
        ->NAME('SetAccountStatus');

    ROUTE::get('/AddNewUser', 'UserAccountsController@addnewuserview')
        ->NAME('AddNewUser');

    ROUTE::post('/AddNewUserOfficial', 'UserAccountsController@addnewuser')
        ->NAME('AddNewUserOfficial');
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Position', 'PositionController@index')
        ->NAME('Position');
    ROUTE::post('/AddPosition', 'PositionController@store')
        ->NAME('AddPosition');
    ROUTE::post('/EditPosition', 'PositionController@edit')
        ->NAME('EditPosition');
});

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Issuance', 'IssuanceController@index')
        ->NAME('Issuance');
    ROUTE::POST('/IssuanceAdd', 'IssuanceController@store')
        ->NAME('IssuanceAdd');
    ROUTE::POST('/IssuanceAddBusiness', 'IssuanceController@storebusinesses')
        ->NAME('IssuanceAddBusiness');
    ROUTE::POST('/IssuanceEdit', 'IssuanceController@edit')
        ->NAME('IssuanceEdit');

    ROUTE::GET('/algor', 'IssuanceController@algor')
        ->NAME('algor');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Personal', 'IssuanceController@personal')
        ->NAME('Personal');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Business', 'IssuanceController@business')
        ->NAME('Business');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Businesses', 'BusinessesController@index')
        ->NAME('BusinessesRecord');
    ROUTE::post('/BusinessStore', 'BusinessesController@store')
        ->NAME('BusinessStore');
});
ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Ordinance', 'OrdinanceController@index')
        ->NAME('Ordinance');
    ROUTE::post('/OrdinanceStore', 'OrdinanceController@store')
        ->NAME('OrdinanceStore');
    ROUTE::post('/OrdinanceUpdate', 'OrdinanceController@update')
        ->NAME('OrdinanceUpdate');
    ROUTE::post('/RemoveOrdinance', 'OrdinanceController@remove')
        ->NAME('RemoveOrdinance');
    ROUTE::post('/ActivateOrdinance', 'OrdinanceController@activate')
        ->NAME('ActivateOrdinance');
    ROUTE::post('/GetOrdinanceImages', 'OrdinanceController@get_images')
        ->NAME('GetOrdinanceImages');
    ROUTE::GET('/OrdinanceExport', 'OrdinanceController@export')
        ->NAME('OrdinanceExport');
});
ROUTE::GET('/VerifyEmail', 'Email@VerifyEmail')
    ->NAME('VerifyEmail');

ROUTE::GROUP(['' => ''], function () {
    ROUTE::GET('/Resolution', 'ResolutionController@index')
        ->NAME('Resolution');
});


Route::group(['prefix' => '/HealthServices'], function () {
    // Checkup
    Route::get('/Checkup', 'CheckupController@index')
        ->name('Checkup');

    Route::get('/LoadPatients', 'CheckupController@load_patients')
        ->name('LoadPatients');
    Route::post('/SearchPatient', 'CheckupController@search_patient')
        ->name('SearchPatient');
    Route::post('/AddCheckup', 'CheckupController@add_checkup')
        ->name('AddCheckup');
    //Patient
    Route::get('/Patient', 'PatientController@index')
        ->name('Patient');
    Route::post('/AddPatient', 'PatientController@add_patient')
        ->name('AddPatient');
    //NewBorn
    Route::group(['prefix' => '/NewBorn'], function () {
        Route::get('/', 'NewbornController@index')
            ->name('NewBorn');
        Route::post('/AddNewBorn', 'NewbornController@CRUDNewborn')
            ->name('CRUDNewborn');
        Route::post('/SpecificNewborn', 'NewbornController@SpecificNewborn')
            ->name('SpecificNewborn');
        Route::get('/Export', 'NewbornController@Export')
            ->name('ExportNewborn');
    });
    //cough
    Route::group(['prefix' => '/ChronicCough'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'ChronicCough')
            ->name('DisplayResidentChronicCough');
        Route::post('/Add', 'HealthServicesController@ChronicCough')
            ->name('ChronicCough');

        Route::get('/ChronicCoughExport', 'HealthServicesController@Export')
            ->defaults('exporttype', 'ChronicCoughExport')

            ->name('ChronicCoughExport');
    });
    //disease
    Route::group(['prefix' => '/ChronicDiseases'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'ChronicDiseases')
            ->name('DisplayResidentChronicDiseases');
        Route::post('/Add', 'HealthServicesController@ChronicDiseases')
            ->name('ChronicDiseases');

        Route::get('/ChronicCoughExport', 'HealthServicesController@Export')
            ->defaults('exporttype', 'ChronicDiseasesExport')

            ->name('ChronicDiseasesExport');
    });
    //pregnant
    Route::group(['prefix' => '/Pregnant'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'Pregnant')
            ->name('DisplayResidentPregnant');
        Route::post('/Add', 'HealthServicesController@CRUDPregnant')
            ->name('CRUDPregnant');
        Route::get('/Export', 'HealthServicesController@Export')
            ->defaults('exporttype', 'PregnantExport')
            ->name('PregnantExport');
    });

    Route::group(['prefix' => '/PWD'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'PWD')
            ->name('DisplayResidentPWD');

        Route::post('/', 'HealthServicesController@CRUDPWD')
            ->name('CRUDPWD');

        Route::get('/PWDExport', 'HealthServicesController@export')
            ->defaults('exporttype', 'PWDExport')
            ->name('PWDExport');
    });

    Route::group(['prefix' => '/Elderly'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'Elderly')
            ->name('DisplayResidentElderly');
        Route::post('/', 'HealthServicesController@CRUDElderly')
            ->name('CRUDElderly');

        Route::get('/ElderlyExport', 'HealthServicesController@export')
            ->defaults('exporttype', 'ElderlyExport')
            ->name('ElderlyExport');
    });
    Route::group(['prefix' => '/Postpartum'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'Postpartum')
            ->name('DisplayResidentPostpartum');

        Route::post('/', 'HealthServicesController@CRUDPostpartum')
            ->name('CRUDPostpartum');
        Route::get('/Export', 'HealthServicesController@Export')
            ->defaults('exporttype', 'PostpartumExport')
            ->name('PostpartumExport');

        Route::post('/SpecificPostpartum', 'HealthServicesController@SpecificPostpartum')
            ->name('SpecificPostpartum');
    });

    Route::group(['prefix' => 'Adolescent'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'Adolescent')
            ->name('DisplayResidentAdolescent');

        Route::post('/', 'HealthServicesController@CRUDAdolescent')
            ->name('CRUDAdolescent');

        Route::get('/AdolescentExport', 'HealthServicesController@export')
            ->defaults('exporttype', 'AdolescentExport')
            ->name('AdolescentExport');
    });

    Route::group(['prefix' => '/FamilyPlanning'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'FamilyPlanning')
            ->name('DisplayResidentFamilyPlanning');
        Route::post('/Add', 'HealthServicesController@CRUDFamilyPlanning')
            ->name('CRUDFamilyPlanning');
    });
    Route::group(['prefix' => '/FPuserVisitation'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'FPUserVisitation')
            ->name('DisplayResidentFPuserVisitation');
        Route::post('/Add', 'HealthServicesController@CRUDFPVisitation')
            ->name('CRUDFPVisitation');
    });
    Route::group(['prefix' => '/Infant'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'Infant')
            ->name('DisplayResidentInfant');

        Route::post('/Add', 'HealthServicesController@CRUDInfant')
            ->name('CRUDInfant');
        Route::post('/SpecificInfant', 'HealthServicesController@SpecificInfant')
            ->name('SpecificInfant');
        Route::get('/Export', 'HealthServicesController@Export')
            ->defaults('exporttype', 'InfantExport')
            ->name('InfantExport');
    });
    Route::group(['prefix' => '/Child'], function () {
        Route::get('/', 'HealthServicesController@ResidentDisplay')
            ->defaults('typeofview', 'Child')
            ->name('DisplayResidentChild');
        Route::post('SpecificChild', 'HealthServicesController@SpecificChild')
            ->name('SpecificChild');
        Route::post('/Add', 'HealthServicesController@CRUDChild')
            ->name('CRUDChild');
        Route::get('/Export', 'HealthServicesController@Export')
            ->defaults('exporttype', 'ChildExport')
            ->name('ChildExport');
    });
});



Route::group(['prefix' => '/PermitCertificateClearance'], function () {


    //Business Evaluation
    Route::get('/BusinessEvaluation', 'PCC\EvaluationController@index')
        ->name('PCCEvaluation');


    //Issuance Verification
    Route::post('/IssuanceEvaluation', 'PCC\EvaluationController@IssuanceEvaluation')
        ->name('IssuanceEvaluation');


    //Permit CertificateClearance Request
    Route::group(['prefix' => '/Request'], function () {
        Route::get('/Permit', 'PCC\RequestController@index')
            ->defaults('typeofview', 'RequestPermit')
            ->name('RequestPermit');

        Route::post('/Permit/Add', 'PCC\RequestController@BusinessIssuanceRequest')
            ->name('BusinessIssuanceRequest');


        Route::get('/Certification', 'PCC\RequestController@index')
            ->defaults('typeofview', 'RequestCertification')
            ->name('RequestCertification');

        Route::get('/Clearance', 'PCC\RequestController@index')
            ->defaults('typeofview', 'RequestClearance')
            ->name('RequestClearance');

        Route::get('/Clearance/NonBusiness', 'PCC\RequestController@index')
            ->defaults('typeofview', 'RequestClearanceNonBusiness')
            ->name('RequestClearanceNonBusiness');

        Route::get('/Clearance/RequestClearanceWeightsAndMeasure', 'PCC\RequestController@index')
            ->defaults('typeofview', 'RequestClearanceWeightsAndMeasure')
            ->name('RequestClearanceWeightsAndMeasure');

        // Clearance
        Route::post('/Clearance/Request', 'PCC\RequestController@CRUDRequestClearance')
            ->name('CRUDRequestClearance');
        //Certificate    
        Route::post('/Certification/Request', 'PCC\RequestController@CRUDRequestCertificate')
            ->name('CRUDRequestCertificate');
    });

    //Issuance 
    Route::get('/Issuance', 'PCC\IssuanceController@index')
        ->name('Issuance');

    Route::post('/SpecificBusiness', 'PCC\IssuanceController@SpecificBusiness')
        ->name('SpecificBusiness');
    
   
        

    Route::post('/SpecificResident', 'PCC\IssuanceController@SpecificResident')
        ->name('SpecificResident');
});

Route::group(['prefix' => '/Business'], function () {
    // Registration
    Route::get('Registration', 'BusinessController@index')
        ->defaults('typeofview', 'business_registration')
        ->name('BusinessApplication');


    Route::post('/Registration/Add', 'BusinessController@CRUDBusinessApplication')
        ->name('CRUDBusinessApplication');

    Route::post('/Registration/SpecificBusiness', 'BusinessController@SpecificBusiness')
        ->name('SpecificBusinessApplication');

    Route::post('/SpecificBuilding', 'BusinessController@SpecificBuilding')
        ->name('SpecificBuilding');   

    Route::post('/EditBuilding', 'BusinessController@EditBuilding')
        ->name('EditBuilding');
    
    Route::post('/editImprovement', 'BusinessController@editImprovement')
        ->name('editImprovement');

        
    //Evaluation

    Route::get('/BusinessEvaluation', 'BusinessController@index')
        ->defaults('typeofview', 'business_evaluation')
        ->name('BusinessEvaluation');



    Route::post('/BusinessEvaluation/Evaluate', 'BusinessController@CRUDBusinessApproval')
        ->name('CRUDBusinessApproval');

    Route::post('/get_occupancy', 'BusinessController@get_occupancy')->name('get_occupancy');
});


Route::group(['prefix' => '/Building'], function () {
    // Registration


    Route::post('/Registration/Add', 'BusinessController@CRUDBuildingApplication')
        ->name('CRUDBuildingApplication');

    Route::get('/Registration', 'BusinessController@index')
        ->defaults('typeofview', 'building_registration')
        ->name('BuildingApplication');


    Route::get('/BuildingEvaluation', 'BusinessController@index')
        ->defaults('typeofview', 'building_evaluation')
        ->name('BuildingEvaluation');
});

Route::group(['prefix' => '/WeightsAndMeasure'], function () {
    // Registration


    Route::post('/Registration/Add', 'BusinessController@CRUDWeightsAndMeasureApplication')
        ->name('CRUDWeightsAndMeasureApplication');

    Route::get('/Registration', 'BusinessController@index')
        ->defaults('typeofview', 'weights_and_measure_registration')
        ->name('WeightsAndMeasureApplication');

    Route::post('/updateWeightsAndMeasure', 'BusinessController@updateWeightsAndMeasure')
        ->name('UpdateWeightsAndMeasure');
});
