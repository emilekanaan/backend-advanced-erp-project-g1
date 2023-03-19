<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\employee_kpi;
use App\Http\Controllers\EmployeeProjectRoleController;
use App\Http\Controllers\CountController;

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
Route::post('/login', [AdminController::class, 'login']);
Route::post('/register', [AdminController::class, 'register']);

Route::middleware(['authorize'])->group(function () {
    // put your protected routes here
    Route::Get('/employee', [EmployeeController::class, 'getEmployees']);
    Route::get('/authenticate', [AdminController::class, 'authenticate'])->name('authenticate');

    Route::get('/admin', [AdminController::class, 'admin']);
    Route::post('/admin/logout', [AdminController::class, 'logout']);
    Route::Get('/admin', [AdminController::class, 'getAdmins']);
    Route::Get('/admin/{id}', [AdminController::class, 'getAdmin']);
    Route::Patch('/admin/{id}', [AdminController::class, 'editAdmin']);
    Route::delete('/admin/{id}', [AdminController::class, 'deleteAdmin']);

    Route::Post('/report', [ReportController::class, 'addReport']);
    Route::Get('/report/{id}', [ReportController::class, 'getReport']);
    Route::Get('/report', [ReportController::class, 'getReports']);
    Route::Patch('/report/{id}', [ReportController::class, 'editReport']);
    Route::delete('/report/{id}', [ReportController::class, 'deleteReport']);

    Route::Get('/employee/{id}', [EmployeeController::class, 'getEmployee']);

    Route::Post('/kpi', [KpiController::class, 'addKpi']);
    Route::Get('/kpi', [KpiController::class, 'getKpis']);
    Route::Get('/kpi/{id}', [KpiController::class, 'getKpi']);
    Route::Patch('/kpi/{id}', [KpiController::class, 'updateKpi']);
    Route::Delete('/kpi/{id}', [KpiController::class, 'deleteKpi']);

    Route::Post('/team', [TeamController::class, 'addTeam']);
    Route::Get('/team/{id}', [TeamController::class, 'getTeam']);
    Route::Delete('/team/{id}', [TeamController::class, 'deleteTeam']);
    Route::Patch('/team/{id}', [TeamController::class, 'editTeam']);

    Route::Post('/role', [RoleController::class, 'addRole']);
    Route::Get('/role/{id}', [RoleController::class, 'getRole']);
    Route::Get('/role', [RoleController::class, 'getRoles']);
    Route::Patch('/role/{id}', [RoleController::class, 'updateRole']);
    Route::delete('/role/{id}', [RoleController::class, 'deleteRole']);

    Route::Get('/employee-project-role', [EmployeeProjectRoleController::class, 'getRoles']);
    Route::Patch('/employee-project-role/{id}', [EmployeeProjectRoleController::class, 'updateRole']);
    Route::Delete('/employee-project-role/{id}', [EmployeeProjectRoleController::class, 'deleteRole']);

    Route::Get('/evaluation', [employee_Kpi::class, 'getEvaluations']);
    Route::Delete('/evaluation/{id}', [employee_Kpi::class, 'deleteEvaluation']);
    Route::Patch('/evaluation/{id}', [employee_Kpi::class, 'editEvaluation']);
    Route::Get('/employee', [EmployeeController::class, 'getEmployees']);

    Route::Get('/count', [CountController::class, 'count']);
    Route::Get('/lastsUpdate', [CountController::class, 'lastsUpdate']);
    Route::Get('/month', [CountController::class, 'Month']);
    Route::Get('/employee/{id}', [EmployeeController::class, 'getEmployee']);
    Route::Get('/evaluation/{id}', [employee_Kpi::class, 'getEvaluation']);
    Route::Post('/evaluation', [employee_Kpi::class, 'addEvaluation']);
    Route::Get('/employee-project-role/{id}', [EmployeeProjectRoleController::class, 'getRole']);
    Route::Post('/employee', [EmployeeController::class, 'addEmployee']);

    Route::Get('/team', [TeamController::class, 'getTeams']);
    Route::Delete('/employee/{id}', [EmployeeController::class, 'deleteEmployee']);
    Route::Patch('/employee/{id}', [EmployeeController::class, 'editEmployee']);
    Route::Get('/project', [ProjectController::class, 'getProjects']);
    Route::Post('/project', [ProjectController::class, 'addProject']);
    Route::Patch('/project/{id}', [ProjectController::class, 'editProject']);
    Route::Delete('/project/{id}', [ProjectController::class, 'deleteProject']);
    Route::Get('/projectTeam/{id}', [ProjectController::class, 'getprojectTeam']);
    Route::Get('/employeeteam/{id}', [EmployeeController::class, 'getemployeeTeam']);
    Route::Post('/employee-project-role', [EmployeeProjectRoleController::class, 'addRole']);
    Route::Get('/project/{id}', [ProjectController::class, 'getProject']);
    
    Route::Get('/employee-role', [EmployeeProjectRoleController::class, 'getRoleProject']);

    Route::Get('/employee-role/{id}/{id1}', [EmployeeProjectRoleController::class, 'getRoleproject']);
});

