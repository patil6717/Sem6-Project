<?php
use App\Http\Controllers\Admincontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logincontroller;

use App\Http\Controllers\AgentController;

use App\Http\Controllers\Buscontroller;
use App\Http\Controllers\BusManageController;

use App\Http\Controllers\TripManage;
use App\Http\Controllers\TripController;

use App\Http\Controllers\TourController;
use App\Http\Controllers\TourManage;

use App\Http\Controllers\BusHireManage;
use App\Http\Controllers\BusHireController;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverManage;

use App\Http\Controllers\PdfMaker;
use App\Models\BusHireRequest;
use App\Models\TicketBooking;
use GuzzleHttp\Middleware;


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

Route::get('/',[TripController::class,'gethome']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);


	Route::get('routemanage', [TripManage::class,'getRoutes'])->name('admin.routes');
    Route::get('shedulemanage', [TripManage::class,'getShedules'])->name('admin.shedules');
    Route::get('allocationmanage', [TripManage::class,'getAllocations'])->name('admin.allocation');
    Route::get('tourmanage', [TourManage::class,'getTour'])->name('admin.tourmanage');
    Route::get('bushiremanage', [BusHireManage::class,'getBushire'])->name('bushiremanage');
    Route::get('busmanage', [BusManageController::class,'getBus'])->name('admin.busmanage');
    Route::get('drivermanage', [DriverManage::class,'getDriver'])->name('admin.drivermanage');
    Route::delete('deleteroute/{id}',[TripManage::class,'deleteroute'])->name('deleteroute');
    Route::post('saveroute', [TripManage::class,'saveroutedata'])->name('saveroute');
    Route::get('addroute',[TripManage::class,'addroute'])->name('addroute');
    Route::post('/bookbushire',[BusHireManage::class,'bookbushire'])->name('bookbushire');
    Route::get('/acceptbushire/{id}',[BusHireManage::class,'acceptbus'])->name('acceptbushire');
    Route::get('/viewbushire1/{id}',[BusHireManage::class,'viewbus'])->name('viewbushire1');
    Route::delete('/deletebushire/{id}',[BusHireManage::class,'deletebus'])->name('deletebushire');
    Route::get('viewroute/{id}',[TripManage::class,'viewroute'])->name('viewroute');
    Route::get('editroutemap/{id}',[TripManage::class,'vieweditroutemap'])->name('admin.editroutemap');
    Route::get('editrouteshedule/{id}',[TripManage::class,'vieweditrouteshedule'])->name('admin.editrouteshedule');
    Route::post('saverouteeditdata',[TripManage::class,'saverouteedit'])->name('saverouteeditdata');
    Route::post('saverouteshedule',[TripManage::class,'saverouteshedule'])->name('saverouteshedule');
    Route::post('saveridshedule',[TripManage::class,'saveridshedule'])->name('saveridshedule');
    Route::get('deleteshedule/{id}',[TripManage::class,'deleteshedule'])->name('deleteshedule');
    Route::get('viewridshedule/{id}',[TripManage::class,'viewridshedule'])->name('viewridshedule');
    Route::get('viewallocate',[TripManage::class,'viewallocate'])->name('viewallocate');
    Route::post('saveallocation',[Tripmanage::class,'saveallocation'] )->name('saveallocation');
   
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('/searchbus',[Buscontroller::class,'searchbus'])->name('searchbus');
Route::get('/employee/pdf', [PdfMaker::class, 'createPDF']);
Route::get('/tour', [TourController::class,'gettour'])->name('tour');

Route::post('/bookticket', [TripController::class,'bookticket'])->name('bookticket');
Route::post('/ticketBooking',[TripController::class,'BookingForm'])->name('getbookingform');

Route::get('/tripbookingdone',[TripController::class,'tripconfirm'])->name('tripbookingdone');
Route::post('/confirmtrip',[TripController::class,'confirmtrip'])->name('confirmtrip');
Route::get('/otpconfirmation',[TripController::class,'otpconfirmation'])->name('otpconfirmation');
Route::post('/printticket',[TripController::class,'printticket'])->name('printticket');
Route::get('/reotp',[TripController::class,'reotp'])->name('reotp');

Route::get('/bushire', [BusHireController::class,'getbushire'])->name('getbushire');
Route::post('/bushire', [BusHireController::class,'requestbus'])->name('requestbus');
Route::view('/viewtripbooking','viewtripbooking')->name('viewtripbooking');
Route::view('viewotprequestbushire','viewotprequestbushire')->name('viewotprequestbushire');
Route::post('viewtrip',[TripController::class,'viewtrip'])->name('viewtrip');
Route::post('viewbushire',[BusHireController::class,'viewbushire'])->name('viewbushire');
Route::post('otpviewbooking',[TripController::class,'otpviewbooking'])->name('otpviewbooking');
Route::post('otpbushirebooking',[BusHireController::class,'otpbushirebooking'])->name('otpbushirebooking');

Route::delete('deletetripview',[TripController::class,'deletetripview'])->name('deletetripview');
Route::post('printtripview', [TripController::class,'printtripview'])->name('printtripview');

Route::post('printacceptedbushire',[BusHireController::class,'printbushire'])->name('printacceptedbushire');
Route::delete('deleterequestbushire',[BusHireController::class,'deletebushire'])->name('deleterequestbushire');
