<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUser;
use App\Http\Requests\SignupUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;



class AuthController extends Controller
{
    
    public function login(LoginUser $request) {
       
        if (!auth()->attempt($request->validated())) {
            return response()->json(['errors' =>["user" => ['User not found']]], 404);
        }
        return auth()->user(); 
       
       
    }

    public function logout() {
        auth()->logout();
        return response('Successfully logged out');
    }

    public function signup(SignupUser $request) {

        $user =  User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]);
            
        return response($user, 201); 
    }

    public function user() {
        return auth()->user();
    }

    
}
