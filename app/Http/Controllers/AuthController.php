<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('Auth.login');
    }

    public function showRegister()
    {
        return view('Auth.register');
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $credentials = $request->only('email', 'password');

            if ($token = JWTAuth::attempt($credentials)) {
                $cookie = cookie('token', $token);

                return response()->json(['message' => 'Login Successful'])->withCookie($cookie);
            }
            return response()->json(['error' => 'Unauthorised'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong']);
        }
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => "required|min:8"
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['success' => 'Registration Successfull']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong']);
        }
    }
}
