<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
   
    public function addRole (Request $request){
        try{
            $request->validate([
            "role1"=>"reaquired|unique"
        ]);
        $role= new role;
        $role1=$request->input('role');
        $role->role=$role1;
        $role->save();

        return response()->json([
            "message"=>$role
        ]);
    }catch(\Exception $e){
        return response()->json([
            "message"=>"Failed to add role"
        ],500);
    }
        
    }
    public function getRole(Request $request ,$id){
        try{
            $role=role::where("id",$id)->get();
            return response()->json([
                "message"=>$role
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message"=>$e->message
            ]);
        }
    }
    public function updateRole(Request $request,$id){
        try{
            $role=role::find($id);
            $input=$request->except("_method");
            $role->update($input);
            return response()->json([
                "message"=>$role
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message"=>$e->message
            ]);
        }
    }
    public function deleteRole(Request $request, $id){
        try{
            $role=role::find($id);
            $role->delete();
            return response ()->json([
                "message"=>"role deleted successfully"
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message"=>$e->message
            ]);
        }
        }
        public function getRoles(Request $request){
            try {
                    if($name=$request->query('search')){
                    $role = role::where('role', 'LIKE', '%' . $name . '%')->paginate(20);
            
                    if (!$role) {
                        return response()->json(['message' => 'role not found'], 404);
                    }
                    return response()->json([
                        'message' => 'role retrive successfully',
                        'roles' => $role,
                    ]);
                }
                
                $roles = Role::get();
                return response()->json($roles, 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to retrieve roles.'], 500);
            }
        }
}
