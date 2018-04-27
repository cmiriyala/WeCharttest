<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('configure-modules', function ($user) {
            if($user->role == "Admin" || $user->role == "Instructor")
            {
                return true;
            }
            return Auth::logout();
        });
        Gate::define('admin-only', function ($user) {
            if($user->role == "Admin")
            {
                return true;
            }
            return Auth::logout();
        });
        Gate::define('student-only', function ($user) {
            if($user->role == "Student")
            {
                return true;
            }
            return Auth::logout();
        });
        Gate::define('instructor-only', function ($user) {
            if($user->role == "Instructor")
            {
                return true;
            }
            return Auth::logout();
        });
        Gate::define('preview', function ($user) {
            if($user->role == "Instructor")
            {
                return true;
            }
            return Auth::logout();
        });
    }
}
