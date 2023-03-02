<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;

class projectController extends Controller
{
    public function addProject(Request $request){
        
        $request->validate([
            
       "name"=> 'required',
       'team_id' => 'nullable|exists:teams,id',

        ]);

        $project = new Project();
      
      $name=$request->input("name");
     
      $team_id=$request->input('team_id');
      $team = Team::find($team_id);
        $project->name=$name;
        $project->team()->associate($team);
        $project->save();
        return response()->json([
            'message' => 'project created successfully'
        ]);
    }
    public function getProject(Request $request, $id){
    try{
        $project =  Project::where("id",$id)->with(['team'])->get();
    
        return response()->json([
            'message' => $project,
        ]);}catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve project.'], 500);
        }
    }

        public function editProject(Request $request, $id){
            try{
            $project=Project::find($id);
            $inputs=$request->except('_method','team_id'); 
            if($request->has('team_id')){
               $team_id=$request->input('team_id');
               $team = Team::find($team_id);
               $project->team()->associate($team);
            }
        
            $project->update($inputs); 
            return response()->json(['message' => 'project successfully updated',
            'project'=>$project
            ])  ;
            }catch (\Exception $e) {
                return response()->json(['message' => 'Failed to edit project.'], 500);
            }
        }
       
        public function getProjects(){
    try {
        $project = Project::paginate(5);
        return response()->json($project, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to retrieve Projects.'], 500);
    }
}
public function deleteProject(Request $request,$id){
    try {
       $project=Project::find($id);
       $project->delete();
       return response()->json(['message' => 'project deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to delete project.'], 500);
    }
} 
}
