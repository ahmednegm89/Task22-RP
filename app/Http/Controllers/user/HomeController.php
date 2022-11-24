<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->get();
        return view('user.index', compact('user'));
    }
    public function show()
    {
        $user = User::where('id', Auth::user()->id)->get();
        return view('user.show', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|min:8',
            'email' => "required|email|max:50|unique:users,email,$id",
            'phone' => "required|min:11|unique:users,phone,$id",
            'password' => '',
            'img' => '',
        ]);

        $name = $user->img;
        if ($request->has('img')) {
            if ($name !== null) {
                unlink(public_path('uploads/users/') . $name);
            }
            $img = $request->img;
            $ext = $img->getClientOriginalExtension();
            $name = "user-" . uniqid() . "_" . rand() . ".$ext";
            $img->move(public_path('uploads/users'), $name);
        }
        // if update password
        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'img' => $name,
            ]);
        }
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'img' => $name,
        ]);
        return redirect()->back();
    }
}
