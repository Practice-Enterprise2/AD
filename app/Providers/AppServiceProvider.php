<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // A gate that allows anything for users with the admin role.
        Gate::after(function ($user, $ability) {
            return $user->hasRole('admin'); // note this returns boolean
        });
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
        static::bootstrap_permission('add_employee', 'Promote a regular user to employee.');
        static::bootstrap_permission('create_role', 'Create authorization roles.');
        static::bootstrap_permission('delete_own_user_account', 'Delete the currently logged in user\'s account.');
        static::bootstrap_permission('edit_own_user_info', 'Edit the currently logged in user\'s info.');
        static::bootstrap_permission('edit_any_user_info', 'Edit any user\'s info.');
        static::bootstrap_permission('edit_permissions', 'Edit all the authorization permissions.');
        static::bootstrap_permission('edit_roles', 'Edit all the authorization roles.');
        static::bootstrap_permission('view_all_roles', 'View all the roles.');
        static::bootstrap_permission('view_all_permissions', 'View all the permissions.');
        static::bootstrap_permission('view_all_users', 'View all the users.');
        static::bootstrap_permission('view_basic_server_info', 'View basic server info like architecture, uptime, OS...');
        static::bootstrap_permission('view_detailed_server_info', 'View detailed (and potentially private) server info.', ['view_basic_server_info']);
        static::bootstrap_permission('view_general_employee_content', 'See general employee content like dashboards, links to dashoards, schedules...');
        static::bootstrap_permission('view_own_user_info', 'View the currently logged in user\'s info.');

        // Create the minimum required roles (user groups).
        $role_admin = static::bootstrap_role('admin', 'User group that is granted all permissions. USE WITH CAUTION!');
        $role_employee = static::bootstrap_role('employee');
        $role_employee_hr = static::bootstrap_role('employee_hr');
        $role_employee_it = static::bootstrap_role('employee_it');
        $role_user = static::bootstrap_role('user');

        $role_employee->givePermissionTo('view_general_employee_content');

        $role_employee_hr->givePermissionTo('view_all_users');
        $role_employee_hr->givePermissionTo('edit_roles');
        $role_employee_hr->givePermissionTo('view_all_roles');
        $role_employee_hr->givePermissionTo('edit_any_user_info');

        $role_employee_it->givePermissionTo('view_basic_server_info');
        $role_employee_it->givePermissionTo('view_all_permissions');

        $role_user->givePermissionTo('edit_own_user_info');
        $role_user->givePermissionTo('delete_own_user_account');

        // Create the minimum required users.
        // Password is letmein
        if (! User::query()->where('email', 'admin@local.test')->first()) {
            $admin_user = User::query()->create([
                'name' => 'Administrator',
                'email' => 'admin@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        if (! User::query()->where('email', 'employee-it@local.test')->first()) {
            $employee_user = User::query()->create([
                'name' => 'Employee IT',
                'email' => 'employee-it@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        if (! User::query()->where('email', 'employee-hr@local.test')->first()) {
            $employee_user = User::query()->create([
                'name' => 'Employee HR',
                'email' => 'employee-hr@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        if (! User::query()->where('email', 'employee@local.test')->first()) {
            $employee_user = User::query()->create([
                'name' => 'Employee',
                'email' => 'employee@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        if (! User::query()->where('email', 'user@local.test')->first()) {
            $regular_user = User::query()->create([
                'name' => 'User',
                'email' => 'user@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        $admin_user = User::query()->where('email', 'admin@local.test')->first();
        $employee_user = User::query()->where('email', 'employee@local.test')->first();
        $employee_hr_user = User::query()->where('email', 'employee-hr@local.test')->first();
        $employee_it_user = User::query()->where('email', 'employee-it@local.test')->first();
        $regular_user = User::query()->where('email', 'user@local.test')->first();

        // Assign each required user their required roles.
        $admin_user->assignRole('admin'); // Admin user automatically gets all permissions!

        $employee_hr_user->assignRole('employee_hr');
        $employee_hr_user->assignRole('employee');
        $employee_hr_user->assignRole('user');

        $employee_it_user->assignRole('employee_it');
        $employee_it_user->assignRole('employee');
        $employee_it_user->assignRole('user');

        $employee_user->assignRole('employee');
        $employee_user->assignRole('user');

        $regular_user->assignRole('user');


        
    }

    // If a permission with the given name doesn't exist, create it.
    public static function bootstrap_role(string $name, null|string $description = null): Role
    {
        if (! Role::query()->where('name', $name)->first()) {
            return Role::create([
                'name' => $name,
                'description' => $description,
            ]);
        } else {
            return Role::findByName($name);
        }
    }

    /**
     * If a permission with the given name doesn't exist yet, create it and
     * attach the given dependencies.
     *
     * @param  array<string>  $dependencies
     */
    public static function bootstrap_permission(string $name, null|string $description = null, array $dependencies = []): Permission
    {
        if (! Permission::query()->where('name', $name)->first()) {
            $new_permission = Permission::create([
                'name' => $name,
                'description' => $description,
            ]);

            foreach ($dependencies as $dependency) {
                $new_permission->grants()->attach(Permission::findByName($dependency));
            }

            return $new_permission;
        } else {
            return Permission::findByName($name);
        }
    }
}
