<?php
namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //Get admin
    public function getAdmin(Request $request, $id)
    {
        try {
            $admin = User::where('id', $id)->get();
            return response()->json([
                'message' => $admin,
            ]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    //Edit admin
    public function editAdmin(Request $request, $id)
    {
        try {
            $admin = User::find($id);
            $inputs = $request->except('_method');
            if ($request->has('password')) {
                $inputs['password'] = Hash::make($request->input('password'));
            }
            if ($request->hasFile('picture')) {
                Storage::delete('public/' . $admin->picture);
                $image_path = $request->file('picture')->store('images', 'public');
                $admin->update(['picture' => $image_path]);
            }
            $admin->update($inputs);

            return response()->json(['message' => 'Admin successfully updated', 'admin' => $admin]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    //get all the admins
    public function getAdmins()
    {
        try {
            $admins = User::paginate(5);
            return response()->json($admins, 200);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    //delete admin
    public function deleteAdmin(Request $request, $id)
    {
        try {
            $admin = User::find($id);
            Storage::delete('public/' . $admin->image);
            $admin->delete();
            return response()->json(['message' => 'admin deleted successfully']);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    //add new admin
    public function register(Request $request)
    {
        try {

            return $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                "picture" => $request->file("picture")->store("images", "public"),
            ]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    //login
   public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    //Auth admin
    public function user()
    {
        try {
            return Auth::user();
        } catch (Throwable $e) {
            report($e);
            return response([
                'message' => 'Success',
            ]);
        }
    }
    public function authenticate()
    {
        return response(['message' => 'please login first']);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'admin' => auth()->user()
        ]);
    }

    //logout admin
    public function logout()
    {
    
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
    
        return response()->json([
            'message' => 'Logged out successfully!',
            'status_code' => 200
        ], 200);

    }
}
