<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('layouts.user.profile.index');
    }

    public function updateAbout(Request $request) {
        $user_id = Auth::user()->id;
        $validatedData = $request->validate([
            'about' => ['string', 'regex:/^[^(|\\]~!%^&*=};:?><’)]*$/'],
        ]);
        $user = User::find($user_id);
        $user->about = $request->about;
        $user->save();
        return redirect()->back()->with('student-success', 'Profile Updated Successfully');
    }

    public function uploadAvatar(Request $request) {
        // dd($request->all());
        $user_id = Auth::user()->id;
        if($request->hasFile('image')) {
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $filename = time() . '.' . $filename;

            $path = $file->storeAs('public/images', $filename);

            $user = User::find($user_id);
            $user->image = $filename;
            $user->save();
            return redirect()->back()->with('student-success', 'Profile Image Updated Successfully');
        }
    }
}
