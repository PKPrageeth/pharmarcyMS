<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createuserpage()
    {

        return view('Backend.register');

    }

    public function createuser(Request $request)
    {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required', 'numeric', 'min:10'],
            'address' => ['required'],
            'dob' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        $address = $request->address;
        $dob = $request->dob;
        $password = Hash::make($request->password);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->contact = $contact;
        $user->address = $address;
        $user->dob = $dob;
        $user->password = $password;
        $user->role = 1;

        $user->save();

        return view('Backend.register');

    }

    public function listuser(Request $request){

      $user=  User::where('role',1)->get();

        return view('Backend.userList')->with('users',$user);


    }
}
