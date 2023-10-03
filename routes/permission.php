<?php

use Illuminate\Support\Facades\Route;


/////////////////////////////////////////////////////////country/////////////////////////////////////////////////////////

Route::get("/country/page", [\App\Http\Controllers\Admin\Location\CountriesController::class, "showCountryPageInfo"]); //1
Route::post("/country/insert", [\App\Http\Controllers\Admin\Location\CountriesController::class, "insertCountry"]);//2
Route::get("/country/get-one/{country_id}", [\App\Http\Controllers\Admin\Location\CountriesController::class, "selectCountryById"]);//3
Route::get("/country/get-all", [\App\Http\Controllers\Admin\Location\CountriesController::class, "selectAllCountry"]);//4
Route::get("/country/del/{country_id}", [\App\Http\Controllers\Admin\Location\CountriesController::class, "deleteCountry"]);//5
Route::get("/country/restore/{country_id}", [\App\Http\Controllers\Admin\Location\CountriesController::class, "restoreCountry"]);//6
Route::post("/country/update/{country_id}", [\App\Http\Controllers\Admin\Location\CountriesController::class, "updateCountry"]);//7

Route::get("/country/relation/ostans/{country_id}", [\App\Http\Controllers\Admin\Location\CountriesController::class, "getOstansOfCountry"]);//8
Route::get("/country/relation/cities/{country_id}", [\App\Http\Controllers\Admin\Location\CountriesController::class, "getCityOfCountry"]);//9


/////////////////////////////////////////////////////////ostan/////////////////////////////////////////////////////////

Route::get("/ostan/page/{country_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "showOstanPageInfo"]);//1
Route::post("/ostan/insert", [\App\Http\Controllers\Admin\Location\OstansController::class, "insertOstan"]);//2
Route::get("/ostan/get-one/{ostan_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "selectOstanById"]);//3
Route::get("/ostan/get-all/{country_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "getAllOstanOfCountry"]);//4
Route::get("/ostan/del/{ostan_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "deleteOstan"]);//5
Route::get("/ostan/restore/{ostan_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "restoreOstan"]);//6
Route::post("/ostan/update/{ostan_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "updateOstan"]);//7

Route::get("/ostan/relation/cities/{ostan_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "getCitiesOfOstan"]);//8
Route::get("/ostan/relation/country/{ostan_id}", [\App\Http\Controllers\Admin\Location\OstansController::class, "getCountryOfOstan"]);//9


/////////////////////////////////////////////////////////city/////////////////////////////////////////////////////////

Route::get("/city/page/{ostan_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "showCityPageInfo"]);//1
Route::post("/city/insert", [\App\Http\Controllers\Admin\Location\CitiesController::class, "insertCity"]);//2
Route::get("/city/get-one/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "selectCityById"]);//3
Route::get("/city/get-all/{ostan_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "getAllCity"]);//4
Route::get("/city/del/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "deleteCity"]);//5
Route::get("/city/restore/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "restoreCity"]);//6
Route::post("/city/update/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "updateCity"]);//7

Route::get("/city/relation/ostan/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "getOstansOfCity"]);//8
Route::get("/city/relation/users/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "getUsersOfCity"]);//9
Route::get("/city/relation/country/{city_id}", [\App\Http\Controllers\Admin\Location\CitiesController::class, "getCountryOfCity"]);//10









/////////////////////////////////////////////////////////permission/////////////////////////////////////////////////////////
//
//// Show Permission Page Info
Route::get("/permission/page", [\App\Http\Controllers\Admin\Permission\Permission\PermissionController::class, "showPermissionInfo"]);
//
//// Insert Permission
Route::post("/permission/insert", [\App\Http\Controllers\Admin\Permission\Permission\PermissionController::class, "insertPermission"]);
//Route::post("/permission/insert/{name_en}/{name_fa}", [\App\Http\Controllers\PermissionController::class, "insert"]);
//
//// Get One Permission
Route::get("/permission/get/{permission_id}", [\App\Http\Controllers\Admin\Permission\Permission\PermissionController::class, "selectPermissionById"]);
//
//// Get All Permissions
Route::get("/permission/get/all", [\App\Http\Controllers\Admin\Permission\Permission\PermissionController::class, "getAllPermissions"]);
//
//// Update Permission
Route::post("/permission/update/{permission_id}", [\App\Http\Controllers\Admin\Permission\Permission\PermissionController::class, "updatePermission"]);
//
//// Delete Permission
Route::get("/permission/del/{permission_id}", [\App\Http\Controllers\Admin\Permission\Permission\PermissionController::class, "deletePermission"]);



/////////////////////////////////////////////////////////role/////////////////////////////////////////////////////////

//// Show Role Page Info
Route::get("/role/page", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "showPageInfo"]);
//
//// Insert Role
Route::post("/role/insert", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "insertRole"]);
//
//// Get One Role
Route::get("/role/get/{role_id}", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "selectRoleById"]);
//
//// Get All Role
Route::get("/role/get-all", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "getAllRole"]);
//
//// Update Role
Route::post("/role/update/{role_id}", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "updateRole"]);
//
//// Delete Role
Route::get("/role/del/{role_id}", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "deleteRole"]);

//// Restore Role
Route::get("/role/restore/{role_id}", [\App\Http\Controllers\Admin\Permission\Role\RoleController::class, "restoreRole"]);

/////////////////////////////////////////////////////////user/////////////////////////////////////////////////////////

//// Show User Page Info
//Route::get("/user/page", [, "showUserPageInfo"]);
//
//// Insert User
//Route::post("/user/insert", [, "insertUser"]);
//
//// Get One User
//Route::get("/user/get/{role_id}/", [, "selectUserById"]);
//
//// Update User
//Route::post("/user/update/{role_id}", [, "updateUser"]);
//
//// Delete User
//Route::get("/user/del/{role_id}", [, "deleteUserById"]);
//
//// All User
//Route::post("/user/all", [, "selectAllUsers"]);
//
//// User Role
//Route::post("/user/roles/{user_id}", [, "getAllRolesOfUser"]);

/////////////////////////////////////////////////////////vip-permission/////////////////////////////////////////////////////////

// Show VIP Permission Page Info
    Route::get("/vippermission/page/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "showVipPermissionPage"]);

// Get All VIP Permissions
    Route::get("/vippermission/users/getall/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "getAllVipPermissionForUser"]);

// Get All VIP Permissions Can Assign To User
    Route::get("/vippermission/users/canassign/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "getAllPermissionCanAssignForUser"]);

// Insert One VIP Permission
    Route::get("/vippermission/user/attach/{user_id}/{permission_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "attachVipPermissionToUser"]);

// Remove One VIP Permission
    Route::get("/vippermission/user/detach/{user_id}/{permission_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "detachVipPermissionFromUser"]);

// Sync VIP Permission
    Route::post("/vippermission/user/sync/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "syncVipPermissionToUser"]);

// Delete all VIP Permissions
    Route::get("/vippermission/user/removeall/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\VipPermissionsController::class, "removeAllVipPermissionFromUser"]);



/////////////////////////////////////////////////////////block-permission/////////////////////////////////////////////////////////

// Show Block Permission Page Info
    Route::get("/blockpermission/page/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "showBlockPermissionPage"]);

// Get All Block Permissions Can Assign To User
    Route::get("/blockpermission/users/canassign/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "getAllBlockPermissionCanAssignForUser"]);

// attach Block Permission
    Route::get("/blockpermission/user/attach/{user_id}/{permission_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "attachBlockPermissionToUser"]);

// sync Block Permission
    Route::post("/blockpermission/user/sync/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "syncBlockPermissionToUser"]);

// Delete One Block Permission
    Route::get("/blockpermission/user/detach/{user_id}/{permission_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "detachBlockPermissionFormUser"]);

// Delete All Block Permission
    Route::get("/blockpermission/user/removeall/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "removeAllBlockPermissionFromUser"]);

// All Block Permission For User
    Route::get("/blockpermission/user/getall/{user_id}", [\App\Http\Controllers\Admin\Permission\SpecPermission\BlockPermissionsController::class, "getAllBlockPermissionOfUser"]);


/////////////////////////////////////////////////////////role-user-relation/////////////////////////////////////////////////////////

//// Show Role-User Page Info
Route::get("/role-user/page/{user_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "showPageRoleOfuser"]);
//
//// All Roles Of User
Route::get("/roles/getall/{user_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "getAllRoleOfUser"]);
//
//// Sync Roles For User
Route::post("/sync/role/user/{user_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "syncRolesForUser"]);
//
//// Attach Role To User
Route::post("/role/user/attach/{user_id}/{role_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "attachRoleToUser"]);
//
//// Detach Role From User
Route::post("/role/user/detach/{user_id}/{role_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "detachRoleFromUser"]);
//
//// Delete All Roles Of User
Route::get("/roles/user/delall/{user_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "deleteAllRoleOfUser"]);
//
//// Roles which User Does Not Have
Route::get("/roles/nouser/getall/{user_id}", [ \App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "getRolesNotHasUser"]);
//
//// All Users Has Role
Route::get("/user/role/getall/{role_id}", [\App\Http\Controllers\Admin\Permission\RoleUserRelation\RoleUserRelationController::class, "getAllUserHasRole"]);




/////////////////////////////////////////////////////////permission-role-relation/////////////////////////////////////////////////////////

//// Show Role-Permission Page Info
Route::get("/permission-role/page", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "showPagePermissionOfRole"]);
//
//// get all roles
Route::get("/permission-role/role/getall", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "getAllRole"]);
//
//// All Permissions Of Role
Route::get("/permissions/getall/{role_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "getAllPermissionOfRole"]);
//
//// Sync Permissions For Role
Route::post("/sync/permissions/role/{role_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "syncPermissionsToRole"]);
//
//// Attach Permission To Role
Route::post("/permissions/role/attach/{role_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "attachPermissionToRole"]);
//
//// Detach Permission From Role
Route::get("/permissions/role/detach/{role_id}/{permission_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "detachPermssionFromRole"]);
//
//// Delete All Permissions Of Role
Route::get("/permissions/role/delall/{role_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "removeAllPermissionOfRole"]);
//
//// Permissions Has Assigned To No Role
Route::get("/permissions/norole/getall/{role_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "getAllPermissionNotInRolePermission"]);
//
//// All Role Has Given Permission
Route::get("/role/permissions/getall/{permission_id}", [\App\Http\Controllers\Admin\Permission\PermissionRoleRelation\PermissionRoleRelationController::class, "getAllRoleHasPermission"]);



/////////////////////////////////////////////////////////final-permission-utils/////////////////////////////////////////////////////////

// Get All Final Permissions
Route::get("/final-permission/getall/{user_id}", [\App\Http\Controllers\Admin\Permission\FinalPermissionUtils\FinalPermissionUtilsController::class, "getFinalPermissionIdsOfUser"]);



/////////////////////////////////////////////////////////customer-karshenas-relation/////////////////////////////////////////////////////////

//// Show Role-User Page Info
Route::get("/customer-karshenas/page", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "showPageCustomerOfKarshenas"]);
//
//// All Roles Of User
Route::get("/customers/getall/{karshenas_id}", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "getAllCustomerOfKarshenas"]);
//
//// get all karshenas
Route::get("/karshenas/getall", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "getAllKarshenas"]);
//
//// Sync Roles For User
Route::post("/sync/customer/karshenas/{karshenas_id}", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "syncCustomerForKarshenas"]);
//
//// Attach Role To User
Route::post("/customer/karshenas/attach/{karshenas_id}", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "attachCustomerToKarshenas"]);
//
//// Detach Role From User
Route::post("/customer/karshenas/detach/{karshenas_id}", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "detachCustomerFromKarshenas"]);
//
//// Delete All Roles Of User
Route::get("/customers/karshenas/delall/{karshenas_id}", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "deleteAllCustomerOfKarshenas"]);
//
//// Roles which User Does Not Have
Route::get("/customers/nokarshenas/getall/{karshenas_id}", [ \App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "getCustomersNotHasKarshenas"]);
//
//// All Users Has Role
Route::get("/karshenas/customer/getall/{customer_id}", [\App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation\CustomerKarshenasRelationController::class, "getAllKarshenasHasCustomer"]);
