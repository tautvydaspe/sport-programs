<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'min:2'],
            'last_name' => ['required', 'max:50', 'min:2'],
            'main_goal' => ['required', 'max:50', 'min:2'],
            'phone_number' => ['required', 'max:15', 'min:9'],
            'email' => ['required', 'email', 'unique:users', 'max:255', 'min:5'],
            'password' =>['required', 'min:6', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'main_goal' => $request->main_goal,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
