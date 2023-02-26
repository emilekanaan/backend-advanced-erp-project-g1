<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Post('/admin',[AdminController::class,'addAdmin']);
Route::Get('/admin',[AdminController::class,'getAdmins']);
Route::Get('/admin/{id}',[AdminController::class,'getAdmin']);
Route::Patch('/admin/{id}',[AdminController::class,'editAdmin']);
Route::delete('/admin/{id}',[AdminController::class,'deleteAdmin']);
Route::post('/admin/login',[AdminController::class,'login']);

Route::Post('/report',[ReportController::class,'addReport']);
Route::Get('/report/{id}',[ReportController::class,'getReport']);
Route::Get('/report',[ReportController::class,'getReports']);
Route::Patch('/report/{id}',[ReportController::class,'editReport']);
Route::delete('/report/{id}',[ReportController::class,'deleteReport']);

Route::Post('/employee',[EmployeeController::class,'addEmployee']);

Route::Post("/kpi", [KpiController::class, "addKpi"]);
Route::Get("/kpi", [KpiController::class, "getKpis"]);
Route::Get("/kpi/{id}", [KpiController::class, "getKpi"]);
Route::Patch("/kpi/{id}", [KpiController::class, "updateKpi"]);
Route::Delete("/kpi/{id}", [KpiController::class, "deleteKpi"]);

