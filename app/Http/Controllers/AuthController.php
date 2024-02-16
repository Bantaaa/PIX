<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function auth(){
        
       return view("auth");
    }
public function signup(Request $request)
{
    $validatedData = $request->validate([
        'Fname' => 'required|string|max:255',
        'Lname' => 'required|string|max:255',
        'phone' => 'required|string|unique:users|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8',
    ]);

    $user = $request->all();
    $user['password'] = Hash::make($request->password);

    User::create($user);

    // $user = User::create([
    //     'Fname' => $request->Fname,
    //     'Lname' => $request->Lname,
    //     'phone' => $request->phone,
    //     'email' => $request->email,
    //     'password' => Hash::make($validatedData['password']),
    //     'bio' => $request->input('bio', null),
    //     'github' => $request->input('github', null),
    //     'linkedin' => $request->input('linkedin', null),
    // ]);
    // User::create([
    //     $validatedData,
    // ]);

    // Redirect the user to the appropriate page
    return redirect()->route('login')->with('success', 'Account created successfully');

    
    // You can also log in the user if needed

    // Redirect to a success page or perform any other action
    // return redirect()->route('success.page');
    }
    public function signin(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Authentication successful
            // session()->put('role', $user->role);
            session()->put([
                // 'role' => $user->role,
                'Fname' => $user->Fname,
                'user_id' => $user->id,
            ]);
            // dd(session('role'));
            return redirect()->route('home'); // Redirect to the intended page or your dashboard
        } else {
            // Authentication failed
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('login'); // Redirect to your logout route after logout
    }

}
