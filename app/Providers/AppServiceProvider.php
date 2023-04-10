<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
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
        // Create the required permissions.
        static::bootstrap_permission('view_general_employee_content', 'See general employee content like dashboards, links to dashoards, schedules...');
        static::bootstrap_permission('view_all_users', 'View all the users.');
        static::bootstrap_permission('view_own_user_info', 'View the currently logged in user\'s info.');
        static::bootstrap_permission('edit_own_user_info', 'Edit the currently logged in user\'s info.');
        static::bootstrap_permission('add_employee', 'Promote a regular user to employee.');
        static::bootstrap_permission('delete_own_user_account', 'Delete the currently logged in user\'s account.');

        // Create the minimum required roles (user groups).
        $role_admin = static::bootstrap_role('admin');
        $role_employee = static::bootstrap_role('employee');
        $role_employee_hr = static::bootstrap_role('employee_hr');
        $role_user = static::bootstrap_role('user');

        $role_employee->givePermissionTo('view_general_employee_content');

        $role_employee_hr->givePermissionTo('view_all_users');

        $role_user->givePermissionTo('edit_own_user_info');
        $role_user->givePermissionTo('delete_own_user_account');

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

        // Assign each required user their required roles.
        $admin_user->assignRole('admin'); // Admin user automatically gets all permissions!

        $employee_user->assignRole('employee');
        $employee_user->assignRole('employee_hr');
        $employee_user->assignRole('user');

        $regular_user->assignRole('user');
    }

    // If a permission with the given name doesn't exist, create it.
    public static function bootstrap_role(string $name, null|string $description = null): Role
    {
        if (! Role::where('name', $name)->first()) {
            return Role::create([
                'name' => $name,
                'description' => $description,
            ]);
        } else {
            return Role::findByName($name);
        }
    }

    // If a permission with the given name doesn't exist, create it.
    public static function bootstrap_permission(string $name, null|string $description = null): Permission
    {
        if (! Permission::where('name', $name)->first()) {
            return Permission::create([
                'name' => $name,
                'description' => $description,
            ]);
        } else {
            return Permission::findByName($name);
        }
    }
}
