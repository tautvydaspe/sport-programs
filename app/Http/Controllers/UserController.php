<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vartotojas;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->role == 0) {
            $users = User::orderBy('id', 'DESC')->get();
        }

        return $users;
    }
}
