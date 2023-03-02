<?php

namespace App\Http\Controllers;
use App\Models\EmployeeKpi;
use App\Models\kpi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\employee;



class employee_kpi extends Controller
{
    public function addEvaluation(Request $request){
        $validator = Validator::make($request->all(),[
            'evaluation'=> ["required", Rule::in([1,2,3,4,5,6,7,8,9,10]),],
            'date'=>'required|date',
            'employee_id'=>'required|exists:employees,id',
            'kpi_id'=>'required|exists:kpis,id',

        ]);

        if($validator ->fails()){
            return response()->json([
                'success' => true,
                'message' => 'Evaluation Failed',
                'error' => $validator->errors(),
            ]);
        }
        $employee_kpi = new EmployeeKpi($validator->validated());

        $employee_kpi->save();
        return response()->json([
            'message' => 'employee created successfully',
            'employee_kpi' => $employee_kpi
        ]);
    }
    public function getEvaluations(){
       
            $evaluation = EmployeeKpi::with(['employee','kpi'])->paginate(5);;
            return response()->json($evaluation, 200);
        
    }
    public function getEvaluation(Request $request, $id){
        try{
            $evaluation =  EmployeeKpi::where("id",$id)->with(['employee','kpi'])->get();
        
            return response()->json([
                'message' => $evaluation,
            ]);}catch (\Exception $e) {
                return response()->json(['message' => 'Failed to retrieve employee.'], 500);
            }
        }
        public function deleteEvaluation(Request $request,$id){
            try {
               $evaluation=EmployeeKpi::find($id);
               $evaluation->delete();
               return response()->json(['message' => 'evaluation deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to delete evaluation.'], 500);
            }
 
        } 

        public function editEvaluation(Request $request, $id){
           try{
            $evaluation=EmployeeKpi::find($id);
            $inputs=$request->except('_method','employee_id','kpi_id'); 
            if($request->has('employee_id')){
               $employee_id=$request->input('employee_id');
               $employee = employee::find($employee_id);
               $evaluation->employee()->associate($employee);
            }
            if($request->has('kpi_id')){

               $kpi_id=$request->input('kpi_id');
               $kpi = kpi::find($kpi_id);
               $evaluation->kpi()->associate($kpi);
            }
            $evaluation->update($inputs); 
            return response()->json(['message' => 'evaluation successfully updated',
            'evaluation'=>$evaluation
            ])  ;
        }catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve employee.'], 500);
        }
            
        }
}
