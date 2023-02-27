<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\evaluation;
use App\Models\employee;
use App\Models\Kpi;

class EvaluationController extends Controller
{
    public function addEvaluation(Request $request){
        
         $request->validate([
             'evaluation' => 'required|in:A,B,C,D,E',
             'employee_id' => 'nullable|exists:employees,id',
             'Kpi_id' => 'nullable|exists:kpis,id',

         ]);
         $evaluation = new Evaluation();
         $evaluation=$request->input("evaluation");
         $evaluation->evaluation=$evaluation;
         $employee_id=$request->input('employee_id');
         $employee = Employee::find($employee_id);
         $Kpi_id=$request->input('Kpi_id');
         $Kpi = Kpi::find($Kpi_id);
        $evaluation->employee()->associate($employee);
        $evaluation->Kpi()->associate($Kpi);

         $evaluation->save();
         return response()->json([
             'message' => 'evaluation created successfully'
         ]);
     }

}
