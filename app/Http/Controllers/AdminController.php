<?php
namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cookie;
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
                $inputs['password'] = bcrypt($request->input('password'));
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
            $admins = User::all();
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
            ]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    //login
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(
                [
                    'message' => 'Login failed',
                ],
                status: 401,
            );
        }
        $user = Auth::user();
        $jwt_name = env('JWT_SECRET');
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie($jwt_name, $token, 68 * 24);
        return response([
            'message' => 'Success',
        ])->withCookie($cookie);
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
