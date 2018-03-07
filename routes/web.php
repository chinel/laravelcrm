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
    return view('index');
});

Route::get('/reset', function (){
    return view('reset');
});

Route::get('/register', function (){

    return view('register');
});

Route::post('/register', 'AdminController@register');

Route::get('/Admin', 'AdminController@adminHome');

Route::get('/AdminStaff','AdminController@AdminGetStaff');

Route::post('/AdminStaff','AdminController@AdminStaff');

Route::get('/Admin/RemoveStaff/{id}','AdminController@AdminRemoveStaff');

Route::get('/Admin/BlockStaff/{id}', 'AdminController@AdminBlockStaff');

Route::get('/Admin/UnblockStaff/{id}','AdminController@AdminUnblockStaff');

Route::get('/Admin/Activities','AdminController@AdminActivities');

Route::get('/Admin/StaffSearch','AdminController@AdminSearchStaff');

Route::get('/Admin/Contact', 'AdminController@AdminContactDetails');
Route::post('/Admin/Contact','AdminController@AdminContact');
Route::get('/Admin/ContactSearch','AdminController@AdminSearchContact');

Route::get('/Admin/ToDoTask','AdminController@AdminToDoTaskDetails');

Route::get('/Admin/Deals','AdminController@AdminDealsDetails');
Route::get('/Admin/ContactChart','AdminController@AdminContactChart');
Route::post('/Admin/SearchContactChart','AdminController@AdminSearchContactChart');

Route::get('/Admin/DealChart','AdminController@AdminDealChart');
Route::post('/Admin/SearchDealChart','AdminController@AdminSearchDealChart');

Route::get('/Admin/TaskChart','AdminController@AdminTaskChart');
Route::post('/Admin/SearchTaskChart','AdminController@AdminSearchTaskChart');








Route::get('/Staff','AdminController@staffHome');
Route::get('/StaffContact', 'AdminController@StaffContactDetails');
Route::post('/StaffContact','AdminController@StaffContact');
Route::get('/Staff/ContactSearch','AdminController@StaffSearchContact');
Route::get('/StaffToDoTask','AdminController@StaffToDoTaskDetails');
Route::post('/StaffToDoTask','AdminController@StaffToDoTask');
Route::post('/StaffMarkTask','AdminController@StaffMarkTask');
Route::get('/StaffDeals','AdminController@StaffDealsDetails');
Route::post('/StaffAddDeal','AdminController@StaffAddDeal');
Route::get('/StaffContactChart','AdminController@StaffContactChart');
Route::post('/StaffSearchContactChart','AdminController@StaffSearchContactChart');

Route::get('/StaffDealChart','AdminController@StaffDealChart');
Route::post('/StaffSearchDealChart','AdminController@StaffSearchDealChart');


Route::get('/StaffTaskChart','AdminController@StaffTaskChart');
Route::post('/StaffSearchTaskChart','AdminController@StaffSearchTaskChart');

Route::get('/StaffProfile','AdminController@StaffProfile');

Route::get('Staff/editContact/{id}/edit','AdminController@editStaffContact');

Route::post('/Staff/updateContact/{id}','AdminController@updateStaffContact');

Route::get('/Staff/removeContact/{id}','AdminController@deleteStaffContact');

Route::get('Staff/mailContact/{id}','AdminController@mailStaffContact');

Route::post('Staff/sendMailContact','AdminController@sendMailToContact');










Route::post('/register','AdminController@register');

Route::get('/resetForm', 'AdminController@resetForm');

Route::post('/resetPassword','AdminController@resetPassword');

Route::post('/updatePassword','AdminController@updatePassword');



// Authentication routes...

Route::get('auth/login', function (){
    return view('index');
});

Route::post('auth/login', 'AdminController@login');
Route::get('auth/logout', 'AdminController@logout');


