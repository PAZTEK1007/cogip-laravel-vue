<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $req) 
    {

        $validator = Validator::make($req->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);


        $user = new User;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        $user->email_verified_at = now();
        $user->role_id = 1;
        $user->api_token = Str::random(60);
        $user->password = Hash::make($req->password);
        $user->save();

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user could not be added.'
            ], 404);
        }
        else {
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        }

    }

    public function login (Request $req)
    {
 
        if (!Auth::attempt($req->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid Credentials.',
            ], 200);
        }
      
        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookies = Cookie::make('jwt', $token, 60 * 24);

        return response()->json([
            'message' => 'Success',
        ])->withCookie($cookies);

    }
    public function logout()
    {
        $cookies = Cookie::forget('jwt');

        return response()->json([
            'message' => 'Success',
        ])->withCookie($cookies);
    }
}
