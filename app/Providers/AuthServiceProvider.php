<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Models\Administrator;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function($user = null) use ($permission) {
                $administratorRoles = Auth::guard('administrator')->user()->roles;
                foreach($administratorRoles as $role) {
                    $rolePermissions = $role->permissions;
                    if ($rolePermissions->contains('name', $permission->name)) {
                        return true;
                    }
                }
                return false;
            });
        }
    }
}
