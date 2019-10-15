<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin\AdminRole;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; //added
use Illuminate\Auth\Events\Registered;

use App\Notifications\Admin\CreateUserNotification;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware(['auth:admin', 'admin.verified']);
        // $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
           
          // load post
          $post = Admin::find(1);
           
          if ($user->can('isSuperAdmin', $post)) {
            // echo "Current logged in user is allowed to update the Post: {$post->id}";
            $roles = Role::select('id','name')->orderBy('id')->get();
                    return view('admin.users.create',compact('roles'));
          } else {
            echo 'Not Authorized.';
          }
        // $roles = Role::select('id','name')->orderBy('id')->get();
        // return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validator($request->all())->validate();

        // event(new Registered($user = $this->createAdminUser($request->all())));

        // $this->guard()->login($user);

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());

        $user = $this->createAdminUser($request->all());

        if($user){
            $this->registered($user);
            return redirect()->route('users.index')
            ->with('success' , 'User created successfully');
        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUser $adminUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = Admin::find($id);
        // dd($user);
        $roles = Role::select('id','name')->orderBy('id')->get();
        return view('admin.users.edit',compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $userUpdate = Admin::where('id', $userId)
                                  ->update([
                                          'name'=> $request->input('name'),
                                          'email' => $request->input('email'),
                                          'password' => Hash::make($request->input('password')),
                                          // 'role_id' => $request->input('roleName'),
                                  ]);
        $updateRole = AdminRole::where('admin_id', $userId)
        ->update([
            'role_id' => $request->input('roleName'), 
            'admin_id' => $userId,
        ]);
        
        if($userUpdate){
            return redirect()->route('users.index')
            ->with('success' , 'User updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // dd($getRole[0]->role_id);
        $findUser = Admin::find($id);
        
        if($findUser->id != 1){
            $deleteAdminRole = AdminRole::where('admin_id', $id)->delete();
            if ($deleteAdminRole) {
              $findUser->delete();  
                //redirect
                return redirect()->route('users.index')
                ->with('success' , 'User deleted successfully');
            }
        }
        
        return back()->withInput()->with('error' , 'Super Admin can not be deleted');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createAdminUser(array $data)
    {
        $admin =  Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['roleName'],
        ]);
        session(['createdUserPassword' => $data['password']]);
        $assignRole = AdminRole::create([
            'role_id' => $data['roleName'], 
            'admin_id' => $admin->id,
        ]);

        return $admin;
    }

    protected function registered($user) {
        $user->notify(new CreateUserNotification($user));
    }
}
