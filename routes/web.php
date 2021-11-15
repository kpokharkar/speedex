<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyDetails;
use App\Http\Controllers\ConsigneeDetails;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorDestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CashController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login-check',[LoginController::class,'loginCheck']);

Route::get('/logout',[LoginController::class,'logout']);

Route::group(['middleware' => ['auth',]], function() {
	
	Route::get('/dashboard',[DashboardController::class,'index']);

	    Route::get('/roles',[RoleController::class,'index']);
    Route::get('/roles/add/{id?}',[RoleController::class,'add']);
    Route::post('/roles/save',[RoleController::class,'save']);

    Route::get('/users',[UserController::class,'index']);
    Route::get('/users/add/{id?}',[UserController::class,'add']);
    Route::post('/users/save',[UserController::class,'save']);
    Route::get('/users/profile',[UserController::class,'profile']);
    Route::get('/users/pasword-change',[UserController::class,'passwordChange']);
    Route::post('/users/pasword-update',[UserController::class,'passwordUpdate']);

	Route::get('/company-details',[CompanyDetails::class,'index']);
	Route::get('/company-details/add/{id?}',[CompanyDetails::class,'add']);
	Route::post('/company-details/save',[CompanyDetails::class,'save']);

	Route::get('/consignee-details',[ConsigneeDetails::class,'index']);
	Route::get('/consignee-details/add/{id?}',[ConsigneeDetails::class,'add']);
	Route::post('/consignee-details/save',[ConsigneeDetails::class,'save']);

	Route::get('/quotation',[QuotationController::class,'index']);
	Route::get('/quotation/sendmail',[QuotationController::class,'sendMail']);
	Route::get('/quotation/add/{id?}',[QuotationController::class,'add']);
	Route::post('/quotation/save',[QuotationController::class,'save']);
	Route::post('/quotation/get-type',[QuotationController::class,'getType']);
	Route::post('/already-exists',[QuotationController::class,'alreadyExists']);


	Route::get('/vendor-master',[VendorController::class,'index']);
	Route::get('/vendor-master/add/{id?}',[VendorController::class,'add']);
	Route::post('/vendor-master/save',[VendorController::class,'save']);

	Route::get('/vendor-destination',[VendorDestinationController::class,'index']);
	Route::get('/vendor-destination/add/{id?}',[VendorDestinationController::class,'add']);
	Route::post('/vendor-destination/save',[VendorDestinationController::class,'save']);

	Route::get('/booking',[BookingController::class,'index']);
	Route::get('/booking/add/{id?}',[BookingController::class,'add']);
	Route::get('/booking/view/{id?}',[BookingController::class,'view']);
	Route::post('/booking/track-save',[BookingController::class,'saveTrack']);
	Route::post('/booking/save',[BookingController::class,'save']);
	Route::post('/booking/view-inscan',[BookingController::class,'viewinscan']);
	Route::post('/booking/view-reason',[BookingController::class,'viewReason']);
	Route::post('/booking/view-out-for-delivery',[BookingController::class,'viewOutfordelivery']);
	Route::post('/booking/view-delivery',[BookingController::class,'viewDelivery']);
	Route::post('/booking/view-pod-attached',[BookingController::class,'viewPodAttached']);
	Route::post('/booking/get-consignee',[BookingController::class,'getConsignee']);
	Route::get('/booking/delete/{id?}',[BookingController::class,'destory']);

	Route::post('/booking/get-destination',[BookingController::class,'getDestination']);
	Route::post('/booking/get-vendor-destination',[BookingController::class,'getVendorDestination']);

	Route::get('/cash',[CashController::class,'index']);
	Route::get('/cash/add/{id?}',[CashController::class,'add']);

});