<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // to dashboard
    public function index() {
        $posts = Post::latest()->paginate(4);

        $posts->appends(request()->all());
        return view('admin-panel.posts.index', compact('posts'));
    }

    // to acc detail page
    public function detail() {
        return view('admin-panel.account.detail');
    }

    // to acc edit page
    public function edit($id) {
        return view('admin-panel.account.edit');
    }

    // to acc update
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'image' => 'mimes:jpg,jpeg,png,webp,svg',
        ]);

        $user = User::find($id);
        $oldImage = $user->image;

        if ($request->hasFile('image')) {
            if ($user->image != null) {
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

        return redirect()->route('admin.detail')->with('successMsg', 'Updated profile successfully!');
    }

    // to admin change password page
    public function changePassword() {
        return view('admin-panel.account.changePassword');
    }

    // to update password
    public function updatePassword(Request $request, $id) {
        $user = User::find($id);
        $request->validate([
            'oldPassword' => 'required|min:8|max:15',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|min:8|max:15|same:newPassword',
        ]);

        if (Hash::check($request->oldPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($request->newPassword),
            ]);

            Auth::logout();
            return redirect()->route('login')->with('successMsg', 'Updated password successfully! Now Login with New Password!');
        } else {
            return back()->with('error', 'Old Password does not true!');
        }
    }
}
