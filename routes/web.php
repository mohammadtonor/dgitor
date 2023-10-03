<?php

use Illuminate\Support\Facades\Route;
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
//
//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/category', function () {
//    return view('Pannel.Category.Category');
//});
//Route::get('/subcategory', function () {
//    return view('Pannel.Category.SubCategory');
//});
//Route::get('/sub3category', function () {
//    return view('Pannel.Category.Sub3');
//});
//Route::get('/exchange', function () {
//    return view('Pannel.Exchange.Exchange');
//});
//Route::get('/catattr', function () {
//    return view('Pannel.Category.AttrCategory');
//});
//
///////////////////////////////پرسنل///////////////////////////////
//Route::get('/insertnewpersonnel', function () {
//    return view('Pannel.Personnel.InsertPersonnel');
//});
//Route::get('/personnellist', function () {
//    return view('Pannel.Personnel.PersonnelList');
//});
//Route::get('/addrsperonnel', function () {
//    return view('Pannel.Personnel.PernonnelAddress');
//});
//Route::get('/personnelcontacts', function () {
//    return view('Pannel.Personnel.PersonnelPhoneNumber');
//});
//Route::get('/personnelbankaccount', function () {
//    return view('Pannel.Personnel.PersonnelBackAccountInfo');
//});
//Route::get('/assignmoshtaraktoemployee', function () {
//    return view('Pannel.Personnel.AssignMoshtarakToEmployee');
//});
//Route::get('/personnelvippermission', function () {
//    return view('Pannel.Personnel.PersonnelVipPermission');
//});
//Route::get('/personnelblockpermission', function () {
//    return view('Pannel.Personnel.PersonnelBlockPermission');
//});
//Route::get('/tags', function () {
//    return view('Pannel.Category.Tags.Tags');
//});
///////////////////////////////////تنظیمات///////////////////////////////
//Route::get('/countries', function () {
//    return view('Pannel.Settings.Countries');
//});
//
////Route::get('/ostans', function () {
////    return view('Pannel.Settings.Ostans');
////});
//Route::get('/cities', function () {
//    return view('Pannel.Settings.City');
//});
//Route::get('/semats', function () {
//    return view('Pannel.Settings.Semats');
//});
//Route::get('/semataccess', function () {
//    return view('Pannel.Settings.SematAccess');
//});




Route::get('favlist', function () {
    return view('Pannel.Exchange.favoriateListUser');
});

Route::get('orderexchange', function () {
    return view('Pannel.Exchange.ExchangeRequestList');
});

Route::get('myssss', function () {
    return view('Pannel.Exchange.requestChangeProductkarmand');
});

Route::get('personnel4', function () {
    return view('Pannel.Exchange.ExchangesMade');
});

Route::get('personnelinsert', function () {
    return view('Pannel.Personnel.InsertPersonnel');
});


Route::get('personnel6', function () {
    return view('Pannel.Personnel.PersonnelList');
});

Route::get('personnel7', function () {
    return view('Pannel.Personnel.PersonnelPhoneNumber');
});

Route::get('personnel8', function () {
    return view('Pannel.Personnel.PersonnelVipPermission');
});
