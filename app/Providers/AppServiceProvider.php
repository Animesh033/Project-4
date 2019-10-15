<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;//added
use Illuminate\Support\Facades\Blade;//added
use Illuminate\Support\Facades\Auth;//added
use Illuminate\Database\Eloquent\Relations\Relation;//added
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);//added
        Blade::if('admin', function () { //added//added
            return Auth::guard('admin')->check();
        });

        Relation::morphMap([ //added
            'states' => 'App\Models\State',
            'cities' => 'App\Models\City',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
