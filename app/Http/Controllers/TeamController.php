<?php

namespace App\Http\Controllers;
use App\Models\Team;

use Illuminate\Http\Request;
   //
class TeamController extends Controller
{
    public function addTeam(Request $request){
        try{
         $request->validate([
             'name' => 'required',
          
         ]);
 
         $team = new Team();
         $name=$request->input("name");
       
         $team->name=$name;
       
         $team->save();
         return response()->json([
             'message' => 'team created successfully'
         ]);}catch (\Exception $e) {
             return response()->json(['message' => 'Failed to add team.'], 500);
         }
     }

     public function getTeams(){
        try {
            $team = Team::all();
            return response()->json($team, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve teams.'], 500);
        }
    }
    public function getTeam(Request $request, $id){
      
            $team =  Team::where("id",$id)->with(['employees'])->get();
        
            return response()->json([
                'message' => $team,
            ]);
        }
}
