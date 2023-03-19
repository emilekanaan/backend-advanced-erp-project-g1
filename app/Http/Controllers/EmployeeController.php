<?php
namespace App\Http\Controllers;
use App\Models\employee;
use App\Models\Team;
use App\Models\EmployeeKpi;
use App\Models\Role;
use App\Models\Project;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    public function addEmployee(Request $request)
    {
 
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone_num' => 'required',
                'picture' => 'required',
                'team_id' => 'nullable|exists:teams,id',
            ]);

            $employee = new Employee();

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone_num = $request->input('phone_num');
            $picture = $request->file('picture')->store('pictures', 'public');
            $team_id = $request->input('team_id');
            $team = Team::find($team_id);
            $employee->first_name = $first_name;
            $employee->last_name = $last_name;
            $employee->email = $email;
            $employee->phone_num = $phone_num;
            $employee->picture = $picture;

            $employee->team()->associate($team);
            $employee->save();
            return response()->json([
                'message' => $employee::with(['team']),
            ]);
       
    }
    public function getEmployee(Request $request, $id)
    {
        $employee = Employee::where('id', $id)
            ->with(['team'])
            ->get();

        return response()->json([
            'message' => $employee,
        ]);
    }

    public function editEmployee(Request $request, $id)
    {
        try {
            $employee = Employee::find($id);
            $inputs = $request->except('_method', 'team_id', 'picture');
            if ($request->has('team_id')) {
                $team_id = $request->input('team_id');
                $team = Team::find($team_id);
                $employee->team()->associate($team);
            }
            if ($request->hasFile('picture')) {
                Storage::delete('public/' . $employee->picture);
                $image_path = $request->file('picture')->store('images', 'public');
                $employee->update(['picture' => $image_path]);
            }
            $employee->update($inputs);
            return response()->json(['message' => 'employee successfully updated', 'employee' => $employee]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to edit employee.'], 500);
        }
    }

    public function getEmployees(Request $request)
    {
        if ($name = $request->query('search')) {
            $employee = Employee::where('first_name', 'LIKE', '%' . $name . '%')->paginate(5);
            if (!$employee) {
                return response()->json(['message' => 'employee not found'], 404);
            }
            return response()->json([
                'message' => 'employee retrive successfully',
                'employees' => $employee,
            ]);
        }
        $employee = Employee::with(['team'])->get();
        return response()->json($employee, 200);
    }
    public function deleteEmployee(Request $request, $id)
    {
        $employee = Employee::find($id);
        Storage::delete('public/' . $employee->picture);
        $employee->delete();
        return response()->json(['message' => 'employee deleted successfully']);
    }
  
    public function getemployeeTeam(Request $request, $id) {
        try {
            $employee =  Employee::where("team_id",$id)->get();

            return response()->json([
                "message" => $employee
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }
 
    
}
