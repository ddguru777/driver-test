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


Route::get('/', function () {
    return redirect()->route('register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search', 'AdminController@search')->middleware('is_admin')->name('search');
Route::get('/search', 'AdminController@search')->middleware('is_admin')->name('search');
Route::get('/edit/{id}', 'AdminController@edit')->middleware('is_admin')->name('edit');
Route::get('/admindelete/{id}', 'AdminController@delete')->middleware('is_admin')->name('admindelete');
Route::post('/editupdate', 'AdminController@update')->middleware('is_admin')->name('editupdate');
Route::get('/sendbasicemail/abc','MailController@basic_email')->name('abc');
Route::get('/sendbasicemail/bookedyes','MailController@bookedyes_email')->name('bookedyes');
Route::get('/sendbasicemail/bookedno','MailController@bookedno_email')->name('bookedno');
Route::get('/sendbasicemail/{name}','bookingcontroller@booking')->name('booking');
Route::get('/sendbasicemail/nobooking/{name}','bookingcontroller@nobooking')->name('nobooking');
Route::get('notify/index', 'NotificationController@index');
Route::post('/update', 'updatecontroller@update')->name('update');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    return "Config Cache is cleared And route";
});
Route::get('/schedlerun', function() {
    Artisan::call('schedule:run');
    return "schedule is launched";
});
Route::get('/payment/{email}', 'PaymentController@payWithpaypal')->name('payment');
Route::get('/pay',function (){
    return view('payment');
})->name('pay');
Route::get('/pays',function (){
    return view('payment');
})->name('pays');
Route::post('/paysuccess',function (){
    return view('paymentsuccess');
});
Route::get('status','PaymentController@getPaymentStatus')->name('status');
