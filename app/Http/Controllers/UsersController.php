<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {

        $formFields = $request->validate(
            [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required|min:6|confirmed'
            ]
        );
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'user created and logged in successfully');
    }
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Logged out successfully');
    }

    public function login()
    {
        return view('users.login');
    }


    public function authenticate(Request $request)
    {
        $formFields = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required'
            ]
        );
        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();

            return redirect('/')->with('message','you are logged in ');
        }

        return back()->withErrors(['email'=>'wrong credintials'])->onlyInput('email');
    }

    public function manage()
    {
       
       return view('Items.manage',['items'=>auth()->user()->items()->get()]);
    }
}
