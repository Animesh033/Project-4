<?php

namespace App\Policies;

use App\Models\Admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isSuperAdmin($superAdmin)
    {
        // dd('Admin ='.$admin->id);
        $superAdminRole = $superAdmin->roles()->get();
        // dd($adminRole);
        return $superAdmin->id == 1 ? ($superAdminRole[0]['name'] == 'Super Admin' ? true : false) : false;
    }

    public function isAdmin($admin)
    {
        // dd('Admin ='.$admin->id);
        $adminRole = $admin->roles()->get();
        // dd($adminRole);
        if($adminRole[0]['name'] == 'Super Admin' || $adminRole[0]['name'] == 'Admin' ){
            return true;
        }
        // return $adminRole[0]['name'] == 'Admin' ? true : false;
    }

    public function isEditor($editor)
    {
        // dd('Admin ='.$admin->id);
        $editorRole = $editor->roles()->get();
        // dd($adminRole);
        if($editorRole[0]['name'] == 'Super Admin' || $editorRole[0]['name'] == 'Admin' || $editorRole[0]['name'] == 'Editor' ){
            return true;
        }
        // return $editorRole[0]['name'] == 'Editor' ? true : false;
    }

    public function isVerified($admin)
    {
        // dd('Admin ='.$admin);
        // $admin = Auth::user();
        return $admin->email_verified_at == NULL ? false : true;
    }


    public function create($admin)
    {
        return true;
    }
}
