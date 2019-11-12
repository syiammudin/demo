<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('migration_import', 'ImportDataMigration') ;

Route::get('vendor_attach/print/{id}', 'VendorAttachmentController@print') ;
Route::get('vendor_attach/{id}/{token}', 'VendorAttachmentController@index') ;
Route::post('vendor_attach/attachment', 'VendorAttachmentController@attachment') ;
Route::post('vendor_attach/send', 'VendorAttachmentController@sendAttachment') ;
Route::post('vendor_attach/action_file', 'VendorAttachmentController@action_file') ;
Route::put('vendor_attach/vendor_attachment/{id}', 'VendorAttachmentController@vendor_attachment') ;
Route::resource('vendor_attach', 'VendorAttachmentController') ;

Route::get('preview-email', function() {
    $data = array('email' => 'emailnya',  'message' => 'Message', 'vendor_name' => 'Nama Vendor');

    return new App\Mail\SendMessageToVendor($data);
});

Auth::routes();
Route::group(['middleware' => 'auth'], function() {

    Route::resource('MedicalClaim', 'DemoMedicalClaimController');
    Route::post('MedicalClaim/upload', 'DemoMedicalClaimController@upload');
    Route::put('MedicalClaim/approve/{id}', 'DemoMedicalClaimController@approve');
    Route::put('MedicalClaim/reject/{id}', 'DemoMedicalClaimController@reject');

    Route::resource('Nda', 'DemoNdaController');
    Route::post('Nda/upload', 'DemoNdaController@upload');
    Route::put('Nda/approve/{id}', 'DemoNdaController@approve');
    Route::put('Nda/reject/{id}', 'DemoNdaController@reject');
    Route::get('Nda/detail/{id}', 'DemoNdaController@detail');

    // masterdata
    Route::resource('/MasterRequest', 'RequestMasterController') ;

    Route::resource('/lineMaintenance', 'LineMaintenanceController') ;
    Route::post('/lineMaintenance/importExcel', 'LineMaintenanceController@importExcel') ;

    Route::resource('/base_maintenance', 'BaseMaintenanceController') ;
    Route::resource('/controller_workshop', 'WorkshopController') ;
    Route::resource('/controller_typesupplier', 'TypeSupplierController') ;

    Route::resource('/PartNumber', 'PartNumberController') ;
    Route::post('/PartNumber/importExcel', 'PartNumberController@importExcel') ;

    Route::resource('/AircraftType', 'AircraftTypeController') ;
    Route::post('/AircraftType/importExcel', 'AircraftTypeController@importExcel') ;

    Route::resource('/UnitOfMeasure', 'UnitofMeasuresController') ;
    Route::resource('/MasterRequest', 'MasterRequestController') ;
    Route::post('/MasterRequest/upload', 'MasterRequestController@upload') ;

    // aircraft Request
    Route::post('/submit_aircraft/upload', 'AircraftRequestController@upload');
    Route::resource('/submit_aircraft','AircraftRequestController') ;
    Route::put('/submit_aircraft/checked/{id}','AircraftRequestController@checked') ;
    Route::post('/submit_aircraft/submit','AircraftRequestController@submit') ;
    Route::put('/submit_aircraft/reject/{id}','AircraftRequestController@reject') ;
    Route::put('/submit_aircraft/approve/{id}','AircraftRequestController@approve') ;
    Route::get('/submit_aircraft/detail/{id}','AircraftRequestController@detail') ;
    Route::get('/submit_aircraft/read/{id}','AircraftRequestController@read') ;
    Route::post('/submit_aircraft/importExcel','AircraftRequestController@importExcel') ;
    Route::post('/submit_aircraft/action_file','AircraftRequestController@action_file') ;
    Route::post('/submit_aircraft/ekstracData','AircraftRequestController@ekstracData') ;
    Route::post('/submit_aircraft/facilities','AircraftRequestController@facilities') ;

    // engine request
    Route::resource('/submit_engine','EngineRequestController') ;
    Route::post('/submit_engine/submit','EngineRequestController@submit') ;
    Route::put('/submit_engine/approve/{id}','EngineRequestController@approve') ;
    Route::put('/submit_engine/checked/{id}','EngineRequestController@checked') ;
    Route::put('/submit_engine/reject/{id}','EngineRequestController@reject') ;
    Route::get('/submit_engine/detail/{id}','EngineRequestController@detail') ;
    Route::post('/submit_engine/importExcel','EngineRequestController@importExcel') ;
    Route::post('/submit_engine/attachment','EngineRequestController@attachment') ;
    Route::get('/submit_engine/read/{id}','EngineRequestController@read') ;
    Route::post('/submit_engine/ekstracData','EngineRequestController@ekstracData') ;

    // special request
    Route::resource('/submit_special','SpecialRequestController') ;
    Route::post('/submit_special/importExcel','SpecialRequestController@importExcel') ;
    Route::post('/submit_special/attachment','SpecialRequestController@attachment') ;
    Route::post('/submit_special/submit','SpecialRequestController@submit') ;
    Route::get('/submit_special/read/{id}','SpecialRequestController@read') ;
    Route::put('/submit_special/checked/{id}','SpecialRequestController@checked') ;
    Route::put('/submit_special/reject/{id}','SpecialRequestController@reject') ;
    Route::put('/submit_special/approve/{id}','SpecialRequestController@approve') ;
    Route::get('/submit_special/detail/{id}','SpecialRequestController@detail') ;
    Route::post('/submit_special/ekstracData','SpecialRequestController@ekstracData') ;

    // component Request
    Route::resource('/submit_component', 'ComponentRequestController') ;
    Route::post('/submit_component/createComponent','ComponentRequestController@createComponent') ;
    Route::get('/submit_component/read/{id}','ComponentRequestController@read') ;
    Route::put('/submit_component/checked/{id}','ComponentRequestController@checked') ;
    Route::put('/submit_component/reject/{id}','ComponentRequestController@reject') ;
    Route::put('/submit_component/approve/{id}','ComponentRequestController@approve') ;
    Route::get('/submit_component/detail/{id}','ComponentRequestController@detail') ;
    Route::put('/submit_component/submitrequest/{id}','ComponentRequestController@submit') ;
    Route::post('/submit_component/ekstracData','ComponentRequestController@ekstracData') ;

    Route::resource('/submit_component_personel', 'ComponentPersonelController') ;
    Route::post('/submit_component_personel/attachment', 'ComponentPersonelController@attachment') ;
    Route::post('/submit_component_personel/action_file', 'ComponentPersonelController@action_file') ;

    Route::resource('/submit_component_document', 'ComponentDocumentController') ;
    Route::post('/submit_component_document/attachment', 'ComponentDocumentController@attachment') ;
    Route::post('/submit_component_document/action_file', 'ComponentDocumentController@action_file') ;

    Route::resource('/submit_component_test_equipment', 'ComponentTestEquipmentController') ;
    Route::post('/submit_component_test_equipment/attachment', 'ComponentTestEquipmentController@attachment') ;
    Route::post('/submit_component_test_equipment/action_file', 'ComponentTestEquipmentController@action_file') ;

    Route::resource('/submit_component_special_tool', 'ComponentSpecialToolController') ;
    Route::post('/submit_component_special_tool/attachment', 'ComponentSpecialToolController@attachment') ;
    Route::post('/submit_component_special_tool/action_file', 'ComponentSpecialToolController@action_file') ;

    Route::resource('/submit_componentMaterialPlanning', 'ComponentMaterialPlanningController') ;
    Route::delete('/submit_componentMaterialPlanning/{id}', 'ComponentMaterialPlanningController@destroy') ;

    Route::resource('/submit_componentManhoursPlanning', 'ComponentManhoursPlanningController') ;
    Route::delete('/submit_componentManhoursPlanning/{id}', 'ComponentManhoursPlanningController@destroy') ;

    Route::post('/submit_component_equivalent', 'ComponentEquivalentController@store') ;
    Route::get('/submit_component_equivalent/{id}', 'ComponentEquivalentController@show') ;

    // vendor Management
    Route::resource('/submit_vendor','VendorManagementController') ;
    Route::post('/submit_vendor/submit','VendorManagementController@submit') ;
    Route::post('/submit_vendor/upload','VendorManagementController@upload') ;
    Route::get('/submit_vendor/detail/{id}','VendorManagementController@detail') ;
    Route::put('/submit_vendor/checked/{id}','VendorManagementController@checked') ;
    Route::put('/submit_vendor/reject/{id}','VendorManagementController@reject') ;
    Route::put('/submit_vendor/approve/{id}','VendorManagementController@approve') ;
    Route::get('/submit_vendor/read/{id}','VendorManagementController@read') ;
    Route::post('/submit_vendor/sendemail','VendorManagementController@sendemail') ;

    Route::get('/tracking_timeline/{id}','TrackingTimelineController@show') ;

    Route::resource('/user','UserController') ;
    Route::post('/user/upload','UserController@upload') ;
    Route::post('/user/action_file','UserController@action_file') ;

    Route::resource('/store','store\StoreController') ;
    Route::get('/store/status/{id}','store\StoreController@status') ;
    Route::get('/store/user_soe/{id}','store\StoreController@user_soe') ;
    Route::get('/store/request_number/{id}','store\StoreController@request_number') ;
    Route::get('/store/aircraft_type/{id}','store\StoreController@aircraft_type') ;
    Route::get('/store/part_number/{id}','store\StoreController@part_number') ;
    Route::get('/store/PartNumberNew/{id}','store\StoreController@PartNumberNew') ;
    Route::get('/store/unit_of_measures/{id}','store\StoreController@unit_of_measures') ;
    Route::get('/store/role_request/{id}','store\StoreController@role_request') ;
    Route::get('/store/for_rating/{id}','store\StoreController@for_rating') ;
    Route::get('/store/full_user_soe/{id}','store\StoreController@full_user_soe') ;
    Route::get('/store/tools/{id}','store\StoreController@tools') ;
    Route::get('/store/notification/{id}','store\StoreController@notification') ;
    Route::get('/store/hangar/{id}','store\StoreController@hangar') ;
    Route::get('/store/workshop/{id}','store\StoreController@workshop') ;
    Route::get('/store/type_supplier/{id}','store\StoreController@type_supplier') ;
    Route::get('/store/techpub/{id}','store\StoreController@techpub') ;
    Route::get('/store/questionare/{id}','store\StoreController@questionare') ;
    Route::get('/store/facilities/{id}','store\StoreController@facilities') ;
    Route::get('/store/main_fn/{id}','store\StoreController@main_fn') ;
    Route::get('/store/NdtMethods/{id}','store\StoreController@NdtMethods') ;
    Route::get('/store/checkPNComponent/{id}','store\StoreController@checkPNComponent') ;
    Route::get('/store/checkPNEngine/{id}','store\StoreController@checkPNEngine') ;
    Route::get('/store/Customer/{id}','store\StoreController@Customer') ;
    Route::get('/store/Issue/{id}','store\StoreController@Issue') ;
    Route::get('/store/shortCaplist/{id}','store\StoreController@shortCaplist') ;

    Route::get('/detailHistory/{id}','detailHistoryController@show') ;
    Route::get('/detailHistory/vendor/{id}','detailHistoryController@vendor') ;

    Route::post('/submit_attachment','ComponenentAttachmentController@store') ;
    Route::post('/submit_attachment/attachment','ComponenentAttachmentController@attachment') ;
    Route::post('/submit_attachment/action_file','ComponenentAttachmentController@action_file') ;
    Route::put('/submit_attachment/{id}','ComponenentAttachmentController@update') ;


    Route::post('/attachmentResubmit','AttachmentResubmitController@store') ;
    Route::get('/attachmentResubmit/{id}','AttachmentResubmitController@show') ;
    Route::post('/attachmentResubmit/attachment','AttachmentResubmitController@attachment') ;
    Route::post('/attachmentResubmit/action_file','AttachmentResubmitController@action_file') ;

    Route::post('/attachmentResubmitVendor','attachmentResubmitVendorController@store') ;
    Route::get('/attachmentResubmitVendor/{id}','attachmentResubmitVendorController@show') ;
    Route::post('/attachmentResubmitVendor/attachment','attachmentResubmitVendorController@attachment') ;
    Route::post('/attachmentResubmitVendor/action_file','attachmentResubmitVendorController@action_file') ;

    Route::get('submit_app_config/{id}','AppConfigController@show') ;
    Route::put('submit_app_config/{id}','AppConfigController@update') ;
    Route::post('submit_app_config/action_file','AppConfigController@action_file') ;
    Route::post('submit_app_config/attachment','AppConfigController@attachment') ;

    Route::get('dashboard','DashboardController@index') ;
    Route::get('dashboard/{id}','DashboardController@show') ;
    Route::get('dashboard/admin/{id}','DashboardController@admin') ;
    Route::get('dashboard/component/{id}','DashboardController@component') ;
    Route::get('dashboard/approveReject/{id}','DashboardController@approveReject') ;
    Route::get('dashboard/capability/{id}','DashboardController@capability') ;
    Route::get('dashboard/vendor/{id}','DashboardController@vendor') ;

    Route::post('submit_decision','DecisionController@store') ;
    Route::get('submit_decision/{id}','DecisionController@show') ;

    Route::resource('submit_questionare','questionareController') ;
    Route::post('submit_questionare/importExcel','questionareController@importExcel') ;

    Route::resource('master_configs','EkstraksMasterConfig') ;
    Route::resource('ndt_method', 'NDTMethodsController') ;
    Route::resource('action_capability','CapabilityListController') ;
    Route::get('action_capability/temporary/{id}','CapabilityListController@temporaryComponent') ;
    Route::get('action_capability/exportexcel/{id}','CapabilityListController@exportexcel') ;
    Route::get('action_capability/ekstractExcel/{id}','CapabilityListController@ekstractExcel') ;

    Route::resource('for_rating','ForRatingController') ;
    Route::resource('MasterCustomerAircraft','AircraftCustomerController') ;

    Route::get('/{any}', 'HomeController@index')->where('any', '.*');

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // Route::get('/home', 'HomeController@index')->name('home');


});
