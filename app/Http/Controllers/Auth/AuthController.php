<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    // VALIDATE AND LOGIN USERS
    public function login(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if (empty($request->email) || empty($request->password)) {
            return redirect()->back()->with('error', 'Field cannot be empty');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $role = json_decode($user->roles);
            if ($role[0]->id > 2) {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Login failed try again');
        }
    }



    public function logout()
    {
        $user = Auth::user();

        Auth::logout();
        return redirect('/login');
    }
}
