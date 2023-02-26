<?php

namespace App\Http\Controllers;
use App\Models\employee;
use App\Models\Team;


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function addEmployee(Request $request){
        
         $request->validate([
             
        "first_name"=> 'required',
        "last_name"=> 'required',
        "email"=> 'required',
        "phone_num"=> 'required',
        "picture"=> 'required'

         ]);
 
         $employee = new Employee();
       
       $first_name=$request->input("first_name");
       $last_name=$request->input("last_name");
       $email=$request->input("email");
       $phone_num=$request->input("phone_num");
       $picture=$request->file("picture")->store('pictures','public');
       $team_id=$request->input('team_id');
         $team=Team::find($team_id);
         $employee->first_name=$first_name;
         $employee->last_name=$last_name;
         $employee->email=$email;
         $employee->phone_num=$phone_num;
         $employee->picture=$picture;
        
         $employee->save();
         return response()->json([
             'message' => 'employee created successfully'
         ]);
     }
     public function getReport(Request $request, $id){
     try{
         $report =  Report::where("id",$id)->get();
     
         return response()->json([
             'message' => $report,
         ]);}catch (\Exception $e) {
             return response()->json(['message' => 'Failed to retrieve Report.'], 500);
         }
     }
 
         public function editReport(Request $request, $id){
             try{
             $report=Report::find($id);
             $inputs=$request->except('_method'); 
             
             $report->update($inputs); 
 
             return response()->json(['message' => 'Report successfully updated',
             'report'=>$report
             ])  ;
             }catch (\Exception $e) {
                 return response()->json(['message' => 'Failed to edit Report.'], 500);
             }
         }
        
         public function getReports(){
     try {
         $report = Report::all();
         return response()->json($report, 200);
     } catch (\Exception $e) {
         return response()->json(['message' => 'Failed to retrieve Reports.'], 500);
     }
 }
 public function deleteReport(Request $request,$id){
     try {
        $report=Report::find($id);
        $report->delete();
        return response()->json(['message' => 'Report deleted successfully']);
     } catch (\Exception $e) {
         return response()->json(['message' => 'Failed to delete Report.'], 500);
     }
 } 
}
