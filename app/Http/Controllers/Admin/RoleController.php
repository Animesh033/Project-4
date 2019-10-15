<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*
 * added by animesh
*/
use Validator;
use Illuminate\Support\Facades\Auth; 

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',['roles'=> $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $messages = [
                'roleName.required' => 'Please enter the role name!',
            ];

            $validator = Validator::make($request->all(), [
                'roleName' => 'required|unique:roles,name|max:255',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('roles.create')
                            ->withErrors($validator)
                            ->withInput();
            }

            $role = Role::create([
                'name' => $request->roleName,
            ]);

            if($role){
                return redirect()->route('roles.index')
                ->with('success' , 'Role created successfully');
            }
        
        }
        return back()->withInput()->with('errors', 'Error creating new Role');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::find($role->id);
        
        return view('admin.roles.edit', ['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $roleUpdate = Role::where('id', $role->id)
                                  ->update([
                                          'name'=> $request->input('roleName'),
                                  ]);
        
        if($roleUpdate){
            return redirect()->route('roles.index')
            ->with('success' , 'Role updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $findrole = Role::find($role->id);
        if($findrole->id !=1){
            if($findrole->delete()){
                
                //redirect
                return redirect()->route('roles.index')
                ->with('success' , 'Role deleted successfully');
            }
        }
        
        return back()->withInput()->with('error' , 'Super Admin role could not be deleted');
    }
}
