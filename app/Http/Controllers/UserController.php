<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        header('Content-Type: application/json');

        if(!$users) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, no users were found.'
            ], 404);
        }
        else {
            return response()->json([
                'success' => true,
                'data' => $users
            ], 200);
        }

    }

    public function show($id)
    {
        $user = User::find($id);

        header('Content-Type: application/json');

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user with id ' . $id . ' cannot be found.'
            ], 404);
        }
        else {
            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        }
    }
    public function user()
    {
        return Auth::user();
    }
}
