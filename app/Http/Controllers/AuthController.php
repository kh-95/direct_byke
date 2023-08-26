<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends AppBaseController
{

    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'password_current' => 'required',
    //         'password' => 'required|string|min:8|confirmed',
    //         'password_confirmation' => 'required',
    //     ]);

    //     $user = User::where('id', auth()->id())->first();
    //     if (!$user) {
    //         return back()->withInput()->with('error', 'Invalid user!');
    //     }
    //     if (Hash::check($request->password_current, $user->password)) {
    //         $user->password = bcrypt($request->password);
    //         $user->save();
    //     }
    //     return back();
    // }


    public function updateProfile(Request $request)
    {
    
        $request->validate([
            'fullname' => 'required',
            'password' => 'required|string|min:8|confirmed',
             'password_confirmation' => 'required',
            'email' => 'required|email|unique:admins,email,' . auth()->id(),
            'phone' => 'required|unique:admins,phone,' . auth()->id(),
        ]);

        $user = Admin::where('id', auth()->id())->first();
        if (!$user) {
            return back()->withInput()->with('error', 'Invalid user!');
        }else{
            $user->update($request->all());
        }
        return back();
    }


}
