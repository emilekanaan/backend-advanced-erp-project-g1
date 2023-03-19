<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kpi;

class KpiController extends Controller
{
    public function addKpi(Request $request) {
        try {
            $request->validate([
                "name" => "required"
            ]);
    
            $kpi = new kpi;
            $name = $request->input("name");
            $kpi->name = $name;
            $kpi->save();
            
            return response()->json([
                "message" => $kpi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to add name"
            ],500);
        }
    }

    public function getKpi(Request $request, $id) {
        try {
            $kpi = kpi::where("id", $id)->get();

            return response()->json([
                "message" => $kpi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }

    public function getKpis(Request $request) {
        try {
            if($name=$request->query('search')){
                $kpi = kpi::where('name', 'LIKE', '%' . $name . '%')->paginate(20);
        
                if (!$kpi) {
                    return response()->json(['message' => 'kpi not found'], 404);
                }
                return response()->json([
                    'message' => 'kpi retrive successfully',
                    'kpis' => $kpi,
                ]);
            }
            $kpi = kpi::get();

            return response()->json([
                "message" => $kpi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }

    public function updateKpi(Request $request, $id) {
        try {
            $kpi = kpi::find($id);
            $inputs = $request->except("_method");
            $kpi->update($inputs);
            
            return response()->json([
                "message" => $kpi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }

    public function deleteKpi(Request $request, $id) {
        try {
            $kpi = kpi::find($id);
            
            $kpi->delete();
            return response()->json([
                "message" => "kpi deleted successfully!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->message
            ]);
        }
    }
}
