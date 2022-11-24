<?php

namespace App\Http\Controllers\admin;

use App\Models\permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorepermissionRequest;
use App\Http\Requests\UpdatepermissionRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = permission::all();
        return view('dashboard.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepermissionRequest $request)
    {
        $validated = $request->validated();

        permission::create([
            'name' => $validated['name'],
        ]);
        return redirect('admin/permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        return view('dashboard.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepermissionRequest  $request
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepermissionRequest $request, permission $permission)
    {
        $validated = $request->validated();

        $permission->update([
            'name' => $validated['name'],
        ]);
        return redirect('admin/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        $permission->delete();
        return redirect(route('permissions.index'));
    }
}
