<?php

namespace App\Http\Controllers;
use App\Models\Team;

use Illuminate\Http\Request;

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
}
