<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Service provider for manual policy to model mapping. When policies are named
 * in a way that they can't be auto-discovered/mapped, they need to be mapped
 * explicitly using this provider.
 *
 * This provider extends the conveniently named AuthServiceProvider, which isn't
 * \Illuminate\Auth\AuthServiceProvider, because why would it be (ffs -_-).
 */
class PolicyMappingServiceProvider extends ServiceProvider
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
    }
}
