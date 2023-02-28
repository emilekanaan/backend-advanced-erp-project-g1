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
        try {
            $team =  Team::where("id",$id)->get();
            return response()->json([
                'message' => $team,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to get team.'], 500);
        }
    }
    
    public function deleteTeam(Request $request, $id){
        try {
            $team = Team::find($id);  
            $team->delete();
            return response()->json([
                "message" => "team deleted successfully!"
            ]);
    }catch (\Exception $e) {
        return response()->json(['message' => 'Failed to get team.'], 500);
    }}
    public function editTeam(Request $request, $id)
{
    try {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['message' => 'Team not found.'], 404);
        }

        $team->name = $request->input('name');
        $team->save();

        return response()->json(['message' => 'Team successfully updated.', 'team' => $team]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to update team.'], 500);
    }
}

}
