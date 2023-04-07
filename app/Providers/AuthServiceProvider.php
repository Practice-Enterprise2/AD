<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        // Register a custom user provider that uses Eloquent for
        // storing/retrieving the actual user data and respects deleted users by
        // their `deleted_at` field.
        Auth::provider('eloquent_custom',
            // $config is the array provided in `config/auth.php` under
            // providers.
            function (Application $app, array $config) {
                return new EloquentUserProvider($this->app['hash'], $config['model']);
            }
        );
    }
}
