<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request) {
        Log::info('Registering user with data: ', $request->only(['name', 'email']));
        try
        {
            $user = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Mail::to($user->email)->send(new WelcomeMail($user));
        return response()->json([
            Log::info('User registered successfully: ', ['user_id' => $user->id]),
            'message' => 'User Registered Succssfully.',
            'User' => $user->only(['name','email'])
        ], 201);
    }
    catch (\Exception $e)
    {
        Log::error('Error registering user: ',['error' => $e->getMessage(),
            'data' => $request->only(['name', 'email'])
        ]);
        return response()->json([
            'message' => 'Registration Failed.',
            'error' => $e->getMessage()
        ], 500);
    }
    }

    public function login(Request $request) {
        try
        {
            $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if(Auth::attempt($request->only('email','password')))
        {
            $user = User::where('email',$request->email)->firstOrFail();
            $token = $user->createToken('auth_login')->plainTextToken;
            return response()->json([
                'message' => 'User Login Succssfully.',
                'User' => $user,
                'Token' => $token
            ], 201);
        }
        else {
            return response()->json([
                'message' => 'invalid user or password',
            ], 401);
        }
        }
        catch (\Exception $e)
        {
            Log::error('Error during user login: ',['error' => $e->getMessage(),
                'data' => $request->only(['email'])
            ]);
            return response()->json([
                'message' => 'Login Failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        Log::info('User logged out successfully: ', ['user_id' => $request->user()->id,'user_info' => $request->user()->only(['name','email'])]);
        return response()->json(['message' => 'User LogOut Succssfully.']);
    }

    public function getProfile($id) {
       $profile = User::find($id)->profile; // to get user profile by id
       return response()->json($profile, 200);
    }

    public function getUserTasks($id) {
        $tasks = User::findOrFail($id)->tasks; // to get user Tasks by id
        return response()->json($tasks, 200);
     }

     public function GetUser() {
        $user_id = Auth::user()->id;
        $userData = User::with('profile')->findOrFail($user_id);
        return new UserResource($userData);
     }
     public function GetAllUser() {
        $userData = User::with('profile')->get();
        return  UserResource::collection($userData);
     }
}
