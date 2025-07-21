<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\WelcomMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $userdata = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Mail::to($request->email)->send(new WelcomMail($userdata));
        return response()->json([
            'messege' => 'Welcome To The Website',
            'User' => ['name' => $request->name, 'email' => $request->email]
        ], 201);
    }

    public function GetUserName(){
        $name = Auth::id();
        return response()->json(['User Name' => $name], 200);
    }

    public function login(Request $request) {
        $request->validate([
            'email'=>'required|email|string',
            'password' => 'required|string|min:8'
        ]);
        if(!Auth::attempt($request->only('email' , 'password'))){
            return response()->json(['messege' => 'Invalid Emali Or Password'], 401);
        }
        $user = User::where('email' , $request->email )->firstorfail();
        $token = $user->createtoken('Auth_Token')->plainTextToken;
        return response()->json([
            'messege' => 'Welcome Back To The Website',
            'User' => $user,
            'Token' => $token
        ], 201);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['messege' => 'Come Back Soon'], 200);
    }

    public function GetUserData($id){
        $user = User::findorfail($id);
        $Data = User::with('profile')->findOrFail($user);
         return  new UserResource($Data);
    }


    public function GetProfile($id)
    {
        $Profile = User::findOrfail($id)->profile;

        return response()->json(
            [
                "messege" => 'The Needed profile',
                'The Profile' => $Profile
            ],
            200
        );
    }
    public function GetTasks($id)
    {
        $Tasks = User::findorfail($id)->tasks;
        return response()->json(
            [
                "messege" => "The Needed Tasks",
                "The Tasks" => $Tasks
            ],
            200
        );
    }
}
