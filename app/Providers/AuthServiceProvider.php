<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Film' => 'App\Policies\FilmPolicy', 
        'App\Actor' => 'App\Policies\ActorPolicy', 
        'App\User' => 'App\Policies\UserPolicy', 
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-page', function($user){
            return $user->role == 'admin';   
        }); 

        //
    }
}
