<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_users() {

        $users = User::all();
        return response()->json(['users' => $users], 200); 
    }

    public function auth_user() {
        if (Auth::check()) {

            $user = Auth::user();
            return response()->json(['user' => $user], 200); 
        }

        return response()->json(['error' => 'Unauthorized'], 401); 
    }
}
