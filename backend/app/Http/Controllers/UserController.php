<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_users() {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }
}
