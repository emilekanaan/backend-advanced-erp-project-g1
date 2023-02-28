<?php

namespace App\Http\Controllers;
use App\Models\employee;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function addEmployee(Request $request){
        try{
         $request->validate([
             
        "first_name"=> 'required',
        "last_name"=> 'required',
        "email"=> 'required',
        "phone_num"=> 'required',
        "picture"=> 'required',
        'team_id' => 'nullable|exists:teams,id',

         ]);
 
         $employee = new Employee();
       
       $first_name=$request->input("first_name");
       $last_name=$request->input("last_name");
       $email=$request->input("email");
       $phone_num=$request->input("phone_num");
       $picture=$request->file("picture")->store('pictures','public');
       $team_id=$request->input('team_id');
       $team = Team::find($team_id);
         $employee->first_name=$first_name;
         $employee->last_name=$last_name;
         $employee->email=$email;
         $employee->phone_num=$phone_num;
         $employee->picture=$picture;
       

         $employee->team()->associate($team);
         $employee->save();
         return response()->json([
             'message' => 'employee created successfully'
         ]);}catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve employee.'], 500);
        }
     }
     public function getEmployee(Request $request, $id){
     try{
         $employee =  Employee::where("id",$id)->with(['team'])->get();
     
         return response()->json([
             'message' => $employee,
         ]);}catch (\Exception $e) {
             return response()->json(['message' => 'Failed to retrieve employee.'], 500);
         }
     }
 
         public function editEmployee(Request $request, $id){
             try{
             $employee=Employee::find($id);
             $inputs=$request->except('_method','team_id','picture'); 
             if($request->has('team_id')){
                $team_id=$request->input('team_id');
                $team = Team::find($team_id);
                $employee->team()->associate($team);
             }
             if($request->hasFile('picture')){
                Storage::delete('public/'.$employee->picture);
                $image_path = $request->file('picture')->store('images','public');
                $employee->update(['picture' => $image_path]);
            }
             $employee->update($inputs); 
             return response()->json(['message' => 'employee successfully updated',
             'employee'=>$employee
             ])  ;
             }catch (\Exception $e) {
                 return response()->json(['message' => 'Failed to edit employee.'], 500);
             }
         }
        
         public function getEmployees(){
     try {
         $employee = Employee::with(['team'])->get();
         return response()->json($employee, 200);
     } catch (\Exception $e) {
         return response()->json(['message' => 'Failed to retrieve Reports.'], 500);
     }
 }
 public function deleteEmployee(Request $request,$id){
   
        $employee=Employee::find($id);
        $employee->delete();
        return response()->json(['message' => 'employee deleted successfully']);
    
 } 
}
