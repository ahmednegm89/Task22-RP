<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '<>', Auth::user()->id)->get();
        $roles = Role::all();
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $img = $validated['img'];
        $ext = $img->getClientOriginalExtension();
        $name = "user-" . uniqid() . "_" . rand() . ".$ext";
        $img->move(public_path('uploads/users'), $name);

        User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'img' => $name,
            'role_id' => $validated['role'],
        ]);
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrfail($id);
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id == 1) {
            if (Auth::user()->id != 1) {
                abort(403);
            }
        }
        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        // if update img 
        $name = $user->img;
        if ($request->has('img')) {
            if ($name !== null) {
                unlink(public_path('uploads/users/') . $name);
            }
            $img = $validated['img'];
            $ext = $img->getClientOriginalExtension();
            $name = "user-" . uniqid() . "_" . rand() . ".$ext";
            $img->move(public_path('uploads/users'), $name);
        }
        // if update password
        if ($validated['password']) {
            $user->update([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'img' => $name,
                'role_id' => $validated['role'],
            ]);
        }
        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'img' => $name,
            'role_id' => $validated['role'],
        ]);
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == 1) {
            if (Auth::user()->id != 1) {
                abort(403);
            }
        }
        if ($user->img !== null) {
            unlink(public_path('uploads/users/') . $user->img);
        }
        $user->delete();
        return redirect(route('users.index'));
    }
}
