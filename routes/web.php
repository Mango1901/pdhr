<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TimeSheetController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\OtherSalaryController;
use App\Http\Controllers\ReportController;
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

Route::group(['middleware' => ['checkAdminLogin'], 'prefix' => '', 'namespace' => 'Admin'], function() {
        Route::prefix('user')->group(function () {
            Route::name("user.")->group(function (){
                Route::get('view',[UserController::class,'getAllUser'])->name("view");
                Route::post('register',[UserController::class,'register'])->name("register");
                Route::get('edit/{id}',[UserController::class,'getEditUser'])->name("edit");
                Route::post('update/{id}',[UserController::class,'UpdateUser'])->name("update");
                Route::get('delete/{id}',[UserController::class,'DeleteUser'])->name("delete");
            });
        });
    Route::prefix('employee')->group(function () {
        Route::name("employee.")->group(function (){
            Route::get('view',[EmployeeController::class,'getAllEmployee'])->name("view");
            Route::post('create',[EmployeeController::class,'createEmployee'])->name("create");
            Route::get('edit/{id}',[EmployeeController::class,'getEditEmployee'])->name("edit");
            Route::post('update/{id}',[EmployeeController::class,'UpdateEmployee'])->name("update");
            Route::get('delete/{id}',[EmployeeController::class,'DeleteEmployee'])->name("delete");
            Route::post('print',[EmployeeController::class,'printEmployee'])->name("print");
        });
    });
    Route::prefix('timeSheet')->group(function () {
        Route::name("timeSheet.")->group(function (){
            Route::get('view',[TimeSheetController::class,'getTimeSheet'])->name("view");
            Route::post('update/{id}',[TimeSheetController::class,'UpdateTimeSheet'])->name("update");
        });
    });
    Route::prefix('salary')->group(function () {
        Route::name("salary.")->group(function (){
            Route::get('view',[SalaryController::class,'getSalary'])->name("view");
            Route::post('create',[SalaryController::class,'createSalary'])->name("create");
            Route::get('edit/{id}',[SalaryController::class,'getEditSalary'])->name("edit");
            Route::post('update/{id}',[SalaryController::class,'UpdateSalary'])->name("update");
            Route::get('delete/{id}',[SalaryController::class,'DeleteSalary'])->name("delete");
            Route::post('print',[SalaryController::class,'printValue'])->name("print");
            Route::post('print-level',[SalaryController::class,'printLevel'])->name("print_level");
        });
    });
    Route::prefix('other-salary')->group(function () {
        Route::name("OtherSalary.")->group(function (){
            Route::get('view',[OtherSalaryController::class,'getOtherSalary'])->name("view");
            Route::post('create',[OtherSalaryController::class,'CreateOtherSalary'])->name("create");
            Route::get('edit/{id}',[OtherSalaryController::class,'getEditOtherSalary'])->name("edit");
            Route::post('update/{id}',[OtherSalaryController::class,'UpdateOtherSalary'])->name("update");
            Route::get('delete/{id}',[OtherSalaryController::class,'DeleteOtherSalary'])->name("delete");
            Route::post('print',[OtherSalaryController::class,'printValue'])->name("print");
        });
    });
    Route::prefix('insurance')->group(function () {
        Route::name("insurance.")->group(function (){
            Route::get('view',[InsuranceController::class,'getInsurance'])->name("view");
            Route::post('create',[InsuranceController::class,'createInsurance'])->name("create");
            Route::get('edit/{id}',[InsuranceController::class,'getEditInsurance'])->name("edit");
            Route::post('update/{id}',[InsuranceController::class,'UpdateInsurance'])->name("update");
            Route::get('delete/{id}',[InsuranceController::class,'DeleteInsurance'])->name("delete");
        });
    });
    Route::prefix('department')->group(function () {
        Route::name("department.")->group(function (){
            Route::get('view',[DepartmentController::class,'getDepartment'])->name("view");
            Route::post('create',[DepartmentController::class,'createDepartment'])->name("create");
            Route::get('edit/{id}',[DepartmentController::class,'getEditDepartment'])->name("edit");
            Route::post('update/{id}',[DepartmentController::class,'UpdateDepartment'])->name("update");
            Route::get('delete/{id}',[DepartmentController::class,'DeleteDepartment'])->name("delete");
        });
    });
    Route::prefix('rewards')->group(function () {
        Route::name("rewards.")->group(function (){
            Route::get('view',[RewardsController::class,'getRewards'])->name("view");
            Route::post('create',[RewardsController::class,'createRewards'])->name("create");
            Route::get('edit/{id}',[RewardsController::class,'getEditRewards'])->name("edit");
            Route::post('update/{id}',[RewardsController::class,'UpdateRewards'])->name("update");
            Route::get('delete/{id}',[RewardsController::class,'DeleteRewards'])->name("delete");
        });
    });
    Route::prefix('report')->group(function () {
        Route::name("report.")->group(function (){
            Route::get('view',[ReportController::class,'getReport'])->name("view");
            Route::post('update/{id}',[ReportController::class,'UpdateReport'])->name("update");
            Route::post('print',[ReportController::class,'printValue'])->name("print");
        });
    });
});
Route::get('/', function () {return view('admin_login');});
Route::get("/login",[AdminController::class,'show_login'])->name("login");
Route::post("/execute-login",[AdminController::class,'execute_login'])->name("execute.login");
Route::get("/logout",[AdminController::class,'logout'])->name("logout");
