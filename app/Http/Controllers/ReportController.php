<?php

namespace App\Http\Controllers;
use App\Models\Report;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function addReport(Request $request){
        try{
         $request->validate([
             'file' => 'required',
          
         ]);
 
         $report = new Report();
         $file=$request->input("file");
       
         $report->file=$file;
       
         $report->save();
         return response()->json([
             'message' => 'Report created successfully'
         ]);}catch (\Exception $e) {
             return response()->json(['message' => 'Failed to add Report.'], 500);
         }
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
         $report = Report::paginate(5);
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
