<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // to user account detail page
    public function detail() {
        return view('ui-panel.account.detail');
    }

    // to edit account page
    public function edit($id) {
        $user = User::find($id);

        return view('ui-panel.account.edit',  compact('user'));
    }

    // to update account
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'image' => 'mimes:png,jpg,jpeg,svg,webp',
        ]);

        $user = User::find($id);

        if($request->hasFile('image')) {
            if($user->image != null) {
                $oldImage = $user->image;

                Storage::delete('public/images/' . $oldImage);
            }

            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/', $newImage);
            $user->update([
                'image' => $newImage,
            ]);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.accoountDetail')->with('successMsg', 'Success!');
    }

    // to change password page
    public function changePassword() {
        return view('ui-panel.account.changePassword');
    }

    // to change password
    public function updatePassword(Request $request) {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'oldPassword' => 'required|min:8|max:15',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|min:8|max:15|same:newPassword',
        ]);

        if(Hash::check($request->oldPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($request->newPassword),
            ]);

            Auth::logout();
            return redirect()->route('login')->with('successMsg', 'Success! Now login with changed password!');
        } else {
            return back()->with('error', 'Old Password Not Match!');
        }
    }
}
