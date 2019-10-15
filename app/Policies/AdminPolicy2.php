<?php

namespace App\Policies;

use App\Models\User\User;
use App\Models\Admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Admin\Admin  $admin
     * @return mixed
     */
    public function view(User $user, Admin $admin)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Admin\Admin  $admin
     * @return mixed
     */
    public function update(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Admin\Admin  $admin
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Admin\Admin  $admin
     * @return mixed
     */
    public function restore(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Admin\Admin  $admin
     * @return mixed
     */
    public function forceDelete(User $user, Admin $admin)
    {
        //
    }


    public function isVerified($admin)
    {
        // dd('Admin ='.$admin);
        // $admin = Auth::user();
        return $admin->email_verified_at == NULL ? false : true;
    }
}
