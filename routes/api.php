<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RoleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
use App\Http\Controllers\EmployeeController;
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
Route::Get('/employee/{id}',[EmployeeController::class,'getEmployee']);
Route::Get('/employee',[EmployeeController::class,'getEmployees']);
Route::Delete('/employee/{id}',[EmployeeController::class,'deleteEmployee']);
Route::Patch('/employee/{id}',[EmployeeController::class,'editEmployee']);




Route::Post("/kpi", [KpiController::class, "addKpi"]);
Route::Get("/kpi", [KpiController::class, "getKpis"]);
Route::Get("/kpi/{id}", [KpiController::class, "getKpi"]);
Route::Patch("/kpi/{id}", [KpiController::class, "updateKpi"]);
Route::Delete("/kpi/{id}", [KpiController::class, "deleteKpi"]);

Route::Post("/team", [TeamController::class, "addTeam"]);
Route::Get("/team", [TeamController::class, "getTeams"]);
Route::Get("/team/{id}", [TeamController::class, "getTeam"]);

Route::Post("/project", [ProjectController::class, "addProject"]);
Route::Get("/project/{id}", [ProjectController::class, "getProject"]);
Route::Patch("/project/{id}", [ProjectController::class, "editProject"]);
Route::Delete("/project/{id}", [ProjectController::class, "deleteProject"]);
Route::Get("/project", [ProjectController::class, "getProjects"]);

Route::Post("/evaluation", [EvaluationController::class, "addEvaluation"]);

Route::Post('/role',[RoleController::class,'addRole']);
Route::Get('/role/{id}',[RoleController::class,'getRole']);
Route::Get('/role',[RoleController::class,'getRoles']);
Route::Patch('/role/{id}',[RoleController::class,'updateRole']);
Route::delete('/role/{id}',[RoleController::class,'deleteRole']);






