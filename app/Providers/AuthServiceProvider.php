<?php

namespace App\Providers;

use App\Models\Admin\Admin;//added
use App\Policies\AdminPolicy;//added

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [
    //     'App\Model' => 'App\Policies\ModelPolicy',
    // ];//commented by animesh
    protected $policies = [ //added
        Admin::class => AdminPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isSuperAdmin', 'App\Policies\AdminPolicy@isSuperAdmin');
        Gate::define('isAdmin', 'App\Policies\AdminPolicy@isAdmin');
        Gate::define('isEditor', 'App\Policies\AdminPolicy@isEditor');
        Gate::resource('admins', 'App\Policies\AdminPolicy', [
            'verified' => 'isVerified',
        ]);

        //
    }
}
