<?php

/*
|--------------------------------------------------------------------------
| Custom Admin login register route by Animesh
|--------------------------------------------------------------------------
*/
Route::namespace('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
	Route::GET('admin/home', 'AdminController@index')->name('admin.home');
    Route::namespace('Auth')->group(function () {
        // Controllers Within The "App\Http\Controllers\Admin\Auth" Namespace
        Route::GET('admin', 'LoginController@showLoginForm')->name('admin.login');
        Route::POST('admin', 'LoginController@login');

        Route::POST('admin-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::GET('admin-password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::POST('admin-password/reset','ResetPasswordController@reset')->name('admin.password.update');
        Route::GET('admin-password/reset/{token}','ResetPasswordController@showResetForm')->name('admin.password.reset');

        Route::GET('admin/register','RegisterController@showRegistrationForm')->name('admin.register')->middleware('can:isSuperAdmin, App\Models\Admin\Admin');
        Route::POST('admin/register','RegisterController@register');

        Route::get('admin/email/verify', 'VerificationController@show')->name('admin.verification.notice');
        Route::get('admin/email/verify/{id}', 'VerificationController@verify')->name('admin.verification.verify');
        Route::get('admin/email/resend', 'VerificationController@resend')->name('admin.verification.resend');
    });
});

/*
|--------------------------------------------------------------------------
| End Custom login register route
|--------------------------------------------------------------------------
*/

/*
|----------------------------------------------------------------------
| Audit Schedule
|-----------------------------------------------------------------------
*/ 
Route::middleware(['auth:admin', 'admin.verified'])->group(function () {
	Route::namespace('Admin')->group(function () {
	    // Controllers Within The "App\Http\Controllers\Admin" Namespace
	    Route::resource('roles', 'RoleController')->middleware('can:isSuperAdmin, App\Models\Admin\Admin');
	    Route::resource('states', 'StateController')->middleware('can:isSuperAdmin, App\Models\Admin\Admin');
	    Route::resource('cities', 'CityController')->middleware('can:isSuperAdmin, App\Models\Admin\Admin');
        Route::resource('clients', 'ClientController')->middleware('can:isAdmin, App\Models\Admin\Admin');
        Route::post('regions/city', 'RegionController@city');
        Route::post('regions/region', 'RegionController@region');
        Route::resource('regions', 'RegionController')->middleware('can:isSuperAdmin, App\Models\Admin\Admin');
        Route::resource('users', 'UserController')->middleware('can:isSuperAdmin, App\Models\Admin\Admin');
	    Route::namespace('Audit')->group(function () {
	    	Route::resource('audits', 'AuditScheduleController')->middleware('can:isEditor, App\Models\Admin\Admin');
	    });
	});
    
});

/*
|----------------------------------------------------------------------
| End Audit Schedule
|-----------------------------------------------------------------------
*/ 

Route::fallback(function () {
    return abort(404);
});