<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;

use App\Models\ParentDetail;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        // reditect user to register page
        return view('ManageUser.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'ic' => 'required|numeric|unique:users,ic',
            'full_name' => 'required|max:255|min:2',
            'phone_num' => 'required|max:12|unique:users,phone_num',
            'password' => 'required|min:5|max:255|confirmed',
            'role' => 'required',
            'gender' => 'required',
            'terms' => 'required'
        ]);
        // dd($attributes);
        $user = User::create($attributes);
        $parentDetail = ParentDetail::create([
            'user_ID' => $user->user_ID,
            // Add any other necessary fields for ParentDetail here
        ]);
        auth()->login($user);

        return redirect('/dashboard');
    }
}
