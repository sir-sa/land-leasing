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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-user', function($user){
            return $user->hasAnyRoles(['admin']);
          });
  
          Gate::define('edit-user', function($user){
            return $user->hasAnyRoles(['admin']);
          });
          Gate::define('delete-user', function($user){
              return $user->hasRole('admin');
            });
    }
}
