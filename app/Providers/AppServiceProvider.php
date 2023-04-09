<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }

    /**
     * Ensure the database is ready for use. Create the users that are required for
     * the application to function properly, create the minimum required roles,
     * create the required permissions...
     *
     * This function is responsible for not creating duplicates when called more than
     * once!
     */
    public static function bootstrap_database(): void
    {
        // Create the minimum required users.
        if (! User::where('email', 'admin@local.test')->first()) {
            $admin_user = User::create([
                'name' => 'Administrator',
                'email' => 'admin@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        if (! User::where('email', 'employee@local.test')->first()) {
            $employee_user = User::create([
                'name' => 'Employee',
                'email' => 'employee@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        if (! User::where('email', 'user@local.test')->first()) {
            $regular_user = User::create([
                'name' => 'User',
                'email' => 'user@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        $admin_user = User::where('email', 'admin@local.test')->first();
        $employee_user = User::where('email', 'employee@local.test')->first();
        $regular_user = User::where('email', 'user@local.test')->first();

        // Create the minimum required roles (user groups).
        Role::firstOrCreate([
            'name' => 'admin',
        ]);

        Role::firstOrCreate([
            'name' => 'employee',
        ]);

        Role::firstOrCreate([
            'name' => 'user',
        ]);

        // Assign each required user their required roles.
        $admin_user->assignRole('admin');

        $employee_user->assignRole('employee');

        $regular_user->assignRole('user');
    }
}
