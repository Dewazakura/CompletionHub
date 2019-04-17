<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    const SYSTEM_ROLE = 1;
    const ISSUER_ROLE = 2;

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

        // for developer role
        Gate::define('system-only', function ($user) {
            return ($user->role === self::SYSTEM_ROLE);
        });

        Gate::define('issuer-role', function ($user) {
            return ($user->role > 0 && $user->role <= self::ISSUER_ROLE);
        });

    }
}
