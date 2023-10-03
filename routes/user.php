<?php

use Illuminate\Support\Facades\Route;


/////////////////////////////////////////////////////////personnel/////////////////////////////////////////////////////////

Route::get("/personnel/showpage", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "showPageInfo"]);//1
Route::post("/personnel/insert", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "insert"]);//2
Route::post("/personnel/insert/page", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "insertPersonelPageInfo"]);
Route::get("/personnel/get/{user_id}", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "selectById"]);//3
Route::get("/personnel/getall/data", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "getAll"]);//4
Route::get("/personnel/del/{user_id}", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "delete"]);//5
Route::get("/personnel/restore/{user_id}", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "restore"]);//6
Route::post("/personnel/update/{user_id}", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "update"]);//7
Route::post("/personnel/search", [\App\Http\Controllers\Admin\Personnel\PersonnelController::class, "search"]);//8


/////////////////////////////////////////////////////////customer/////////////////////////////////////////////////////////

Route::get("/customer/page", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "showPageInfo"]);//1 -> OK
Route::get("/customer/insert/page", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "insertPageInfo"]);//2 -> OK
Route::post("/customer/insert", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "insert"]);//3 -> OK
Route::get("/customer/get/{user_id}", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "selectById"]);//4 -> OK
Route::get("/customer/getall/data", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "getAll"]);//5 -> OK
Route::get("/customer/del/{user_id}", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "delete"]);//6 -> OK
Route::get("/customer/restore/{user_id}", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "restore"]);//7 -> OK
Route::post("/customer/update/{user_id}", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "update"]);//8 -> OK
Route::post("/customer/search", [\App\Http\Controllers\Admin\Customer\CustomerController::class, "search"]);//9 -> OK


/////////////////////////////////////////////////////////customer-karsehnas///////////////////////////////////////////////

//customer
Route::get("/customer-karsehnas/page/{customer_id}", [\App\Http\Controllers\Admin\CustomerKarshenas\CustomerKarsehnasController::class, "showPageKarshenasOfCustomer"]); //1 -> OK
Route::post("/customer-karsehnas/sync/{customer_id}", [\App\Http\Controllers\Admin\CustomerKarshenas\CustomerKarsehnasController::class, "syncKarshenasToCustomer"]); //2 -> OK

//karshenas
Route::get("/karsehnas-customer/page/{karshenas_id}", [\App\Http\Controllers\Admin\CustomerKarshenas\CustomerKarsehnasController::class, "showPageCustomerOfKarshenas"]);
Route::post("/karsehnas-customer/sync/{karshenas_id}", [\App\Http\Controllers\Admin\CustomerKarshenas\CustomerKarsehnasController::class, "syncCustomerToKarshenas"]);


/////////////////////////////////////////////////////////User-Address/////////////////////////////////////////////////////////

Route::get("/user/address/page/{user_id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "showPageInfo"]);// 1
Route::post("/user/address/insert/{user_id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "insert"]);// 2
Route::get("/user/address/get-one/{id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "selectById"]); // 3
Route::get("/user/address/get-all/{user_id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "selectAllAddress"]); // 4
Route::get("/user/address/del/{id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "delete"]); // 5
Route::get("/user/address/restore/{id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "restore"]); // 6
Route::post("/user/address/update/{id}", [\App\Http\Controllers\Admin\User\Address\UserAddressController::class, "update"]); // 7

/////////////////////////////////////////////////////////User-Phone/////////////////////////////////////////////////////////

Route::get("/user/phone/page/{user_id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "showPageInfo"]); // 1
Route::post("/user/phone/insert/{user_id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "insert"]); // 2
Route::get("/user/phone/get-one/{id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "selectById"]); // 3
Route::get("/user/phone/get-all/{user_id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "selectAllPhones"]); // 4
Route::get("/user/phone/del/{id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "delete"]); // 5
Route::get("/user/phone/restore/{id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "restore"]); // 6
Route::post("/user/phone/update/{id}", [\App\Http\Controllers\Admin\User\Phone\PhoneController::class, "update"]); // 7

/////////////////////////////////////////////////////////User-Bank-Account/////////////////////////////////////////////////////////

Route::get("/user/bank/page/{user_id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "showPageInfo"]); // 1
Route::post("/user/bank/insert/{user_id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "insert"]); // 2
Route::get("/user/bank/get-one/{id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "selectById"]); // 3
Route::get("/user/bank/get-all/{user_id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "selectAllBankAccount"]); // 4
Route::get("/user/bank/del/{id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "delete"]); // 5
Route::get("/user/bank/restore/{id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "restore"]); // 6
Route::post("/user/bank/update/{id}", [\App\Http\Controllers\Admin\User\BankAccount\BankAccountController::class, "update"]); //7

/////////////////////////////////////////////////////////User-File/////////////////////////////////////////////////////////


// Delete
Route::get("/user/file/del/{id}", [\App\Http\Controllers\Admin\User\File\UserFileController::class, "deleteUserFile"]);

// Get List
Route::get("/user/file/getlist/{id}", [\App\Http\Controllers\Admin\User\File\UserFileController::class, "getFilelistOfUserFile"]);

// Upload
Route::get("/user/file/upload/{user_id}", [\App\Http\Controllers\Admin\User\File\UserFileController::class, "uploadFileForUserFile"]);

// remove
Route::get("/user/file/rm/{id}", [\App\Http\Controllers\Admin\User\File\UserFileController::class, "removeFileFromUserFile"]);

// Delete
Route::get("/user/file/dl/{id}", [\App\Http\Controllers\Admin\User\File\UserFileController::class, "getFileOfUserFile"]);

// Restore
Route::get("/user/file/dl/base64/{id}", [\App\Http\Controllers\Admin\User\File\UserFileController::class, "downloadFileOfUserAsBase64Format"]);


/////////////////////////////////////////////////////////User-Madarek/////////////////////////////////////////////////////////

// Get One
Route::get("/user/madarek/get/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "selectById"]);

// Get All
Route::get("/user/madarek/getall", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "selectAll"]);

// Delete
Route::get("/user/madarek/del/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "delete"]);

// Restore
Route::get("/user/madarek/restore/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "restore"]);

// Restore
Route::get("/user/madarek/getlist/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "getMadareklistOfUser"]);

// Restore
Route::get("/user/madarek/rm/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "removeMadarekFromUserMadarek"]);

// Restore
Route::post("/user/madarek/upload/{user_id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "upload"]);

// Restore
Route::get("/user/madarek/dl/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "getMadarekOfUserMadarek"]);

// Restore
Route::get("/user/madarek/dl/base64/{id}", [\App\Http\Controllers\Admin\User\Madarek\MadarekController::class, "downloadFileOfUserAsBase64Format"]);



