<?php
use App\Http\Controllers\Admincontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logincontroller;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Buscontroller;
use App\Http\Controllers\BusManageController;

use App\Http\Controllers\TripManage;
use App\Http\Controllers\TripController;

use App\Http\Controllers\TourController;
use App\Http\Controllers\TourManage;

use App\Http\Controllers\BusHireManage;
use App\Http\Controllers\BusHireController;
use App\Http\Controllers\BusManage;
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

Route::get('/',[TripController::class,'gethome'])->name('gettrip');

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
     Route::get('/copydata/{date}',[TripManage::class,'copydata'])->name('admin.copydata');
     Route::get('/drivers',[DriverManage::class,'getDrivers'])->name('admin.drivers');
     Route::get('/driversonleave',[DriverManage::class,'getDriversleave'])->name('admin.driversonleave');
     Route::post('/savedriver',[DriverManage::class,'saveDriver'])->name('savedriver');
     Route::post('/editdriver',[DriverManage::class,'editdriver'])->name('editdriver');
     Route::delete('/deletedriver',[DriverManage::class,'deletedriver'])->name('deletedriver');
     Route::post('savebusmaintain',[BusManage::class,'savebusmaintain'])->name('savebusmaintain');
     Route::post('deletebusmaintain',[BusManage::class,'deletebusmaintain'])->name('deletebusmaintain');
        Route::get('/buses',[BusManage::class,'getBuses'])->name('admin.buses');
        Route::get('/busmaintanance',[BusManage::class,'getBusmaintain'])->name('admin.busmaintanance');
        Route::post('/savebus',[BusManage::class,'savebus'])->name('savebus');
        Route::post('/editbus',[BusManage::class,'editbus'])->name('editbus');
        Route::post('/deletebus',[BusManage::class,'deletebus'])->name('deletebus');
        Route::get('routemanage', [TripManage::class,'getRoutes'])->name('admin.routes');
        Route::get('shedulemanage', [TripManage::class,'getShedules'])->name('admin.shedules');
        Route::get('allocationmanage', [TripManage::class,'getAllocations'])->name('admin.allocation');
        Route::get('tourmanage', [TourManage::class,'getTour'])->name('admin.tourmanage');
        Route::get('station', [TripManage::class,'getstation'])->name('admin.station');
        Route::post('savestation', [TripManage::class,'savestation'])->name('admin.savestation');
        Route::post('editstation', [TripManage::class,'editstation'])->name('admin.editstation');
        Route::post('deletestation', [TripManage::class,'deletestation'])->name('admin.deletestation');
      
      
        Route::get("/addtour1", [TourManage::class,'viewaddtour'])->name("admin.addtour1");
        Route::post("/savetour", [TourManage::class,'savetour'])->name("admin.savetour");
        
        Route::get('hotel', [TourManage::class,'gethotel'])->name('admin.hotel');
        Route::post('savehotel', [TourManage::class,'savehotel'])->name('admin.savehotel');
        Route::delete('deletehotel', [TourManage::class,'deletehotel'])->name('admin.deletehotel');
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
        //Route::get('tour',[TourManage::class,'gettour'])->name('admin.tours');
});
//Route::get('tour',[TourManage::class,'viewallocate'])->name('admin.tours');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('/searchbus',[Buscontroller::class,'searchbus'])->name('searchbus');
Route::get('/employee/pdf', [PdfMaker::class, 'createPDF']);
Route::get('/tour', [TourController::class,'gettour'])->name('tour');
Route::post('/gettourform',[TourController::class,'gettourform'])->name('gettourform');
Route::post('/savetourbooking',[TourController::class,'savetourbooking'])->name('savetourbooking');
Route::get('/viewtourbooking/{id}',[TourController::class,'viewtourbooking'])->name('viewtourbooking');
Route::post('/printtourticket',[TourController::class,'printtourticket'])->name('printtourticket');
Route::post('/bookticket', [TripController::class,'bookticket'])->name('bookticket');
Route::post('/ticketBooking',[TripController::class,'BookingForm'])->name('getbookingform');
Route::delete('deletetourview',[TourController::class,'deletetourview'])->name('deletetourview');
Route::post('printtourview',[TourController::class,'printtourview'])->name('printtourview');
Route::get('/tripbookingdone',[TripController::class,'tripconfirm'])->name('tripbookingdone');
Route::post('/confirmtrip',[TripController::class,'confirmtrip'])->name('confirmtrip');
Route::get('/otpconfirmation',[TripController::class,'otpconfirmation'])->name('otpconfirmation');
Route::post('/printticket',[TripController::class,'printticket'])->name('printticket');
Route::get('/reotp',[TripController::class,'reotp'])->name('reotp');

Route::get('/bushire', [BusHireController::class,'getbushire'])->name('getbushire');
Route::post('/bushire', [BusHireController::class,'requestbus'])->name('requestbus');
Route::view('/viewtripbooking','viewtripbooking')->name('viewtripbooking');
Route::view('/viewtourbooking','viewtourbooking1')->name('viewtourbooking');
Route::view('viewotprequestbushire','viewotprequestbushire')->name('viewotprequestbushire');
Route::post('viewtrip',[TripController::class,'viewtrip'])->name('viewtrip');
Route::post('viewtour',[TourController::class,'viewtour'])->name('viewtour');

Route::post('viewbushire',[BusHireController::class,'viewbushire'])->name('viewbushire');
Route::post('otpviewbooking',[TripController::class,'otpviewbooking'])->name('otpviewbooking');
Route::post('otpviewbookingtour',[TourController::class,'otpviewbookingtour'])->name('otpviewbookingtour');

Route::post('otpbushirebooking',[BusHireController::class,'otpbushirebooking'])->name('otpbushirebooking');
Route::get('/logout',[TripController::class,'logout'])->name('logout');
Route::delete('deletetripview',[TripController::class,'deletetripview'])->name('deletetripview');
Route::post('printtripview', [TripController::class,'printtripview'])->name('printtripview');

Route::post('printacceptedbushire',[BusHireController::class,'printbushire'])->name('printacceptedbushire');
Route::delete('deleterequestbushire',[BusHireController::class,'deletebushire'])->name('deleterequestbushire');
