<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->role == 0) {
            $users = User::orderBy('id', 'DESC')->get();
        }

        return $users;
    }

    public function store(Request $request)
    {
        if($request->user()->role == 0) {
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
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

    public function update(Request $request, $id)
    {
        if($request->user()->role == 0) {
            $existingUser = User::find( $id );

            if( $existingUser ) {
                $existingUser->name = $request->get("name");
                $existingUser->last_name = $request->get("last_name");
                $existingUser->main_goal = $request->get("main_goal");
                $existingUser->phone_number = $request->get("phone_number");
                $existingUser->email = $request->get("email");
                $existingUser->save();
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->role == 0) {
            $existingUser = User::find($id);

            if ($existingUser) {
                $existingUser->delete();
                return "Trainer successfully deleted.";
            }
            return "Trainer not found";
        }
    }
}
