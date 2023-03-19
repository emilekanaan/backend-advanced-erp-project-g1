<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Models\EmployeeProjectRole;

class EmployeeProjectRoleController extends Controller
{
    public function addRole(Request $request) {
        $validator = Validator::make($request->all(), [
            "employee_id" => "required|exists:employees,id",
            "project_id" => "required|exists:projects,id",
            "role_id" => "required|exists:roles,id",    
        ]);

        if($validator ->fails()){
            return response()->json([
                "success" => true,
                "message" => "Adding Role failed",
                "error" => $validator->errors(),
            ]);
        }

        $employee_project_role = new EmployeeProjectRole($validator->validated());

        $employee_project_role->save();
        return response()->json([
            "message" => "Role created successfully",
            "employee_project_role" => $employee_project_role,
        ]);
    }

    public function getRoles(Request $request) {
        try {
            $employee_project_role = EmployeeProjectRole::with("employee","project", "role");
            return response()->json([
                "message" => $employee_project_role
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }

    public function getRole(Request $request, $id) {
        try {
            $employee_project_role =  EmployeeProjectRole::where("employee_id",$id)->with(["employee","project", "role"])->get();

            return response()->json([
                "message" => $employee_project_role
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }
    

    public function updateRole(Request $request, $id) {
        try {
            $employee_project_role = EmployeeProjectRole::find($id);
            $inputs = $request->except("_method");

            if($request->has('employee_id')){
                $employee_id=$request->input('employee_id');
                $employee = employee::find($employee_id);
                $employee_project_role->employee()->associate($employee);
             }

             if($request->has('project_id')){
                $project_id=$request->input('project_id');
                $project = Project::find($project_id);
                $employee_project_role->project()->associate($project);
             }

             if($request->has('role_id')){
                $role_id=$request->input('role_id');
                $role = Role::find($role_id);
                $employee_project_role->role()->associate($role);
             }


            $employee_project_role->update($inputs);
            
            return response()->json([
                "message" => $employee_project_role
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }

    public function deleteRole(Request $request, $id) {
        try {
            $employee_project_role = EmployeeProjectRole::find($id);
            
            $employee_project_role->delete();
            return response()->json([
                "message" => "deleted successfully!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }
    public function getRoleproject(Request $request, $id,$id1) {
        try {
            $employee_project_role =  EmployeeProjectRole::where("Project_id",$id)->where("employee_id", $id1)->with([ "role"])->get();
    
            return response()->json([
                "message" => $employee_project_role
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }
    
}

