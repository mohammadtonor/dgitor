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

/////////////////////////////////////////////////////////Holding/////////////////////////////////////////////////////////

// Holding Show Page
Route::get("/holding/page", [\App\Http\Controllers\Admin\Organization\Holding\HoldingController::class, "showPageInfo"]);

// Holding Insert
Route::post("/holding/insert", [\App\Http\Controllers\Admin\Organization\Holding\HoldingController::class, "insert"]);

// Holding Select By Id
Route::get("/holding/getone/{holding_id}", [\App\Http\Controllers\Admin\Organization\Holding\HoldingController::class, "selectById"]);

// Holding Select All
Route::get("/holding/getall", [\App\Http\Controllers\Admin\Organization\Holding\HoldingController::class, "selectAll"]);

// Holding Update
Route::post("/holding/update/{holding_id}", [\App\Http\Controllers\Admin\Organization\Holding\HoldingController::class, "update"]);

// Holding Delete
Route::get("/holding/del/{holding_id}", [\App\Http\Controllers\Admin\Organization\Holding\HoldingController::class, "delete"]);



/////////////////////////////////////////////////////////Organization/////////////////////////////////////////////////////////

// Organization Show Page
Route::get("/org/page/{holding_id}", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "showOrganizationPageInfo"]);

// All Organization Show Page
Route::get("/org/all/page", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "showAllOrganizationPageInfo"]);

// Organization Insert
Route::post("/org/insert", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "insert"]);

// Organization Select By Id
Route::get("/org/getone/{org_id}", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "selectById"]);

// Organization Select All
Route::get("/org/getall", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "selectAll"]);

// Organization Update
Route::post("/org/update/{org_id}", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "update"]);

// Organization Delete
Route::get("/org/del/{org_id}", [\App\Http\Controllers\Admin\Organization\Organization\OrganizationController::class, "delete"]);



/////////////////////////////////////////////////////////Org Dept/////////////////////////////////////////////////////////

// Org Dept Show Page
Route::get("/org-dept/page/{org_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptController::class, "showPageInfo"]);

// Org Dept Insert
Route::post("/org-dept/insert", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptController::class, "insert"]);

// Org Dept Select By Id
Route::get("/org-dept/getone/{org_dept_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptController::class, "selectById"]);

// Org Dept Select All
Route::get("/org-dept/getall", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptController::class, "selectAll"]);

// Org Dept Update
Route::post("/org-dept/update/{org_dept_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptController::class, "update"]);

// Org Dept Delete
Route::get("/org-dept/del/{org_dept_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptController::class, "delete"]);



/////////////////////////////////////////////////////////Org Dept Relation/////////////////////////////////////////////////////////

// Org Dept Insert
Route::post("/org-dept/rel/insert", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptRelationController::class, "insert"]);

// Org Dept Select By Id
Route::get("/org-dept/rel/getone/{org_det_rel_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptRelationController::class, "selectById"]);

// Org Dept Select All
Route::get("/org-dept/rel/getall", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptRelationController::class, "selectAll"]);

// Org Dept Update
Route::post("/org-dept/rel/update/{org_det_rel_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptRelationController::class, "update"]);

// Org Dept Delete
Route::get("/org-dept/rel/del/{org_det_rel_id}", [\App\Http\Controllers\Admin\Organization\Organization\Dept\OrgDeptRelationController::class, "delete"]);



/////////////////////////////////////////////////////////Org Position/////////////////////////////////////////////////////////


// Org Dept Show Page
Route::get("/org-pos/page", [\App\Http\Controllers\Admin\Organization\OrgPosition\OrgPositionController::class, "showPageInfo"]);

// Org Dept Insert
Route::post("/org-pos/insert", [\App\Http\Controllers\Admin\Organization\OrgPosition\OrgPositionController::class, "insert"]);

// Org Dept Select By Id
Route::get("/org-pos/getone/{org_pos_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\OrgPositionController::class, "selectById"]);

// Org Dept Select All
Route::get("/org-pos/getall", [\App\Http\Controllers\Admin\Organization\OrgPosition\OrgPositionController::class, "selectAll"]);

// Org Dept Update
Route::post("/org-pos/update/{org_pos_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\OrgPositionController::class, "update"]);

// Org Dept Delete
Route::get("/org-pos/del/{org_pos_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\OrgPositionController::class, "delete"]);



/////////////////////////////////////////////////////////Position User Archive/////////////////////////////////////////////////////////

// Org Dept Show Page
Route::get("/pos-user/page/{user_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveController::class, "showPageInfo"]);

// Org Dept Insert
Route::post("/pos-user/insert", [\App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveController::class, "insert"]);

// Org Dept Select By Id
Route::get("/pos-user/getone/{pos_user_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveController::class, "selectById"]);

// Org Dept Select All
Route::get("/pos-user/getall", [\App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveController::class, "selectAll"]);

// Org Dept Update
Route::post("/pos-user/update/{pos_user_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveController::class, "update"]);

// Org Dept Delete
Route::get("/pos-user/del/{pos_user_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveController::class, "delete"]);



/////////////////////////////////////////////////////////Org Position Material/////////////////////////////////////////////////////////

// Org Dept Show Page
Route::get("/pos-matr/page/{org_postion_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\Material\OrgPositionMaterialController::class, "showPageInfo"]);

// Org Dept Insert
Route::post("/pos-matr/insert", [\App\Http\Controllers\Admin\Organization\OrgPosition\Material\OrgPositionMaterialController::class, "insert"]);

// Org Dept Select By Id
Route::get("/pos-matr/getone/{org_pos_matr_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\Material\OrgPositionMaterialController::class, "selectById"]);

// Org Dept Select All
Route::get("/pos-matr/getall", [\App\Http\Controllers\Admin\Organization\OrgPosition\Material\OrgPositionMaterialController::class, "selectAll"]);

// Org Dept Update
Route::post("/pos-matr/update/{org_pos_matr_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\Material\OrgPositionMaterialController::class, "update"]);

// Org Dept Delete
Route::get("/pos-matr/del/{org_pos_matr_id}", [\App\Http\Controllers\Admin\Organization\OrgPosition\Material\OrgPositionMaterialController::class, "delete"]);



/////////////////////////////////////////////////////////Pay Slip/////////////////////////////////////////////////////////

// pay-slip Show Page
Route::get("/pay-slip/page/{user_id}", [\App\Http\Controllers\Admin\Organization\PaySlip\PaySlipController::class, "showPageInfo"]);

// pay-slip Insert
Route::post("/pay-slip/insert", [\App\Http\Controllers\Admin\Organization\PaySlip\PaySlipController::class, "insert"]);

// pay-slip Select By Id
Route::get("/pay-slip/getone/{pay_slip_id}", [\App\Http\Controllers\Admin\Organization\PaySlip\PaySlipController::class, "selectById"]);

// pay-slip Select All
Route::get("/pay-slip/getall", [\App\Http\Controllers\Admin\Organization\PaySlip\PaySlipController::class, "selectAll"]);

// pay-slip Update
Route::post("/pay-slip/update/{pay_slip_id}", [\App\Http\Controllers\Admin\Organization\PaySlip\PaySlipController::class, "update"]);

// pay-slip Delete
Route::get("/pay-slip/del/{pay_slip_id}", [\App\Http\Controllers\Admin\Organization\PaySlip\PaySlipController::class, "delete"]);



/////////////////////////////////////////////////////////Position Pay Salary/////////////////////////////////////////////////////////

// pay-slip Show Page
Route::get("/pos-pay-salary/page", [\App\Http\Controllers\Admin\Organization\PositionPaySalary\PositionPaySalaryController::class, "showPageInfo"]);

// pay-slip Insert
Route::post("/pos-pay-salary/insert", [\App\Http\Controllers\Admin\Organization\PositionPaySalary\PositionPaySalaryController::class, "insert"]);

// pay-slip Select By Id
Route::get("/pos-pay-salary/getone/{pos_pay_salary_id}", [\App\Http\Controllers\Admin\Organization\PositionPaySalary\PositionPaySalaryController::class, "selectById"]);

// pay-slip Select All
Route::get("/pos-pay-salary/getall", [\App\Http\Controllers\Admin\Organization\PositionPaySalary\PositionPaySalaryController::class, "selectAll"]);

// pay-slip Update
Route::post("/pos-pay-salary/update/{pos_pay_salary_id}", [\App\Http\Controllers\Admin\Organization\PositionPaySalary\PositionPaySalaryController::class, "update"]);

// pay-slip Delete
Route::get("/pos-pay-salary/del/{pos_pay_salary_id}", [\App\Http\Controllers\Admin\Organization\PositionPaySalary\PositionPaySalaryController::class, "delete"]);



/////////////////////////////////////////////////////////Fiscal Year/////////////////////////////////////////////////////////

// Fiscal Year Show Page
Route::get("/fis-year/page/{mavared_hoghooghe_sals_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\FiscalYearController::class, "showPageInfo"]);

// Fiscal Year Insert
Route::post("/fis-year/insert", [\App\Http\Controllers\Admin\Organization\SalaryItem\FiscalYearController::class, "insert"]);

// Fiscal Year Select By Id
Route::get("/fis-year/getone/{fiscal_year_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\FiscalYearController::class, "selectById"]);

// Fiscal Year Select All
Route::get("/fis-year/getall", [\App\Http\Controllers\Admin\Organization\SalaryItem\FiscalYearController::class, "selectAll"]);

// Fiscal Year Update
Route::post("/fis-year/update/{fiscal_year_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\FiscalYearController::class, "update"]);

// Fiscal Year Delete
Route::get("/fis-year/del/{fiscal_year_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\FiscalYearController::class, "delete"]);



/////////////////////////////////////////////////////////Fiscal Year/////////////////////////////////////////////////////////

// Salary Item Of Year Show Page
Route::get("/salary-item/page/{org_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\SalaryItemOfYearController::class, "showPageInfo"]);

// Fiscal Year Insert
Route::post("/salary-item/insert", [\App\Http\Controllers\Admin\Organization\SalaryItem\SalaryItemOfYearController::class, "insert"]);

// Fiscal Year Select By Id
Route::get("/salary-item/getone/{salary_item_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\SalaryItemOfYearController::class, "selectById"]);

// Fiscal Year Select All
Route::get("/salary-item/getall", [\App\Http\Controllers\Admin\Organization\SalaryItem\SalaryItemOfYearController::class, "selectAll"]);

// Fiscal Year Update
Route::post("/salary-item/update/{salary_item_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\SalaryItemOfYearController::class, "update"]);

// Fiscal Year Delete
Route::get("/salary-item/del/{salary_item_id}", [\App\Http\Controllers\Admin\Organization\SalaryItem\SalaryItemOfYearController::class, "delete"]);
