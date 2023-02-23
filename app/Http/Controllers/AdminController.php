<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
class AdminController extends Controller
{
    public function addAdmin(Request $request){
       try{
        $request->validate([
            'username' => 'required|unique:admins|min:3',
            'email' => 'required|unique:admins|email',
            'password' => 'required|min:6',
        ]);

        $admin = new Admin();
        $username=$request->input("username");
        $email=$request->input("email");
        $password=$request->input("password");
        $admin->username=$username;
        $admin->email=$email;
        $admin->password=$password;
        $admin->save();
        return response()->json([
            'message' => 'Admin created successfully'
        ]);}catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add admin.'], 500);
        }
    }
    public function getAdmin(Request $request, $id){
    try{
        $admin =  Admin::where("id",$id)->get();
    
        return response()->json([
            'message' => $admin,
        ]);}catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve admin.'], 500);
        }
    }

        public function editAdmin(Request $request, $id){
            try{
            $admin=Admin::find($id);
            $inputs=$request->except('_method'); 
            $admin->update($inputs); 
            return response()->json(['message' => 'Admin successfully updated',
            'admin'=>$admin
            ])  ;
            }catch (\Exception $e) {
                return response()->json(['message' => 'Failed to edit admin.'], 500);
            }
        }
       
        public function getAdmins(){
    try {
        $admins = Admin::all();
        return response()->json($admins, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to retrieve admins.'], 500);
    }
}
public function deleteAdmin(Request $request,$id){
    try {
       $admin=Admin::find($id);
       $admin->delete();
       return response()->json(['message' => 'admin deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to delete admins.'], 500);
    }
}
}



