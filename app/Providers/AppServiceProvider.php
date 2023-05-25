<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
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
        Model::preventsSilentlyDiscardingAttributes(! App::isProduction());

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
        static::bootstrap_permission('edit_all_shipments', 'Edit all the shipments.');
        static::bootstrap_permission('view_all_roles', 'View all the roles.');
        static::bootstrap_permission('view_all_permissions', 'View all the permissions.');
        static::bootstrap_permission('view_all_users', 'View all the users.');
        static::bootstrap_permission('view_all_employees', 'View all the employees.');
        static::bootstrap_permission('view_basic_server_info', 'View basic server info like architecture, uptime, OS...');
        static::bootstrap_permission('view_detailed_server_info', 'View detailed (and potentially private) server info.', ['view_basic_server_info']);
        static::bootstrap_permission('view_general_employee_content', 'See general employee content...');
        static::bootstrap_permission('view_own_user_info', 'View the currently logged in user\'s info.');
        static::bootstrap_permission('view_all_complaints', 'view complaints from customers and handle complaint');
        static::bootstrap_permission('view_employee_count', 'the amount of employees in the company');
        static::bootstrap_permission('view_reviews', 'the reviews of the customers');
        static::bootstrap_permission('add_vacant_jobs', 'add a vacant job');
        static::bootstrap_permission('edit_vacant_jobs', 'mark a vacant job as filled and view the applicants');
        static::bootstrap_permission('edit_any_review', 'Edit any of the reviews, regardless of who created them.');
        static::bootstrap_permission('delete_any_review', 'Delete any review, regardless of who created them.');
        static::bootstrap_permission('view_all_shipments', 'View all the shipments, regardless of who they belong to.');
        static::bootstrap_permission('delete_any_shipment', 'Delete any of the shipments, regardless of who they belong to.');
        static::bootstrap_permission('accept_any_shipment', 'Accept any shipment for shipping.');
        static::bootstrap_permission('edit_any_employee', 'Edit all of the information on any employee.');
        static::bootstrap_permission('view_all_invoices', 'View a list of all invoices and be able to resend the invoice email');
        static::bootstrap_permission('change_employee_contracts', 'View the contracts of all employees and be able to create new contracts');

        static::bootstrap_permission('view_all_orders', 'View graph order prediction.');
        // Create the minimum required roles (user groups).
        $role_admin = static::bootstrap_role('admin', 'User group that is granted all permissions. USE WITH CAUTION!');
        $role_employee = static::bootstrap_role('employee');
        $role_employee_hr = static::bootstrap_role('employee_hr');
        $role_employee_it = static::bootstrap_role('employee_it');
        $role_user = static::bootstrap_role('user');
        $role_management = static::bootstrap_role('management');

        // Assign the necessary permissions to all the roles.
        $role_employee->givePermissionTo('view_general_employee_content');
        $role_employee->givePermissionTo('view_all_complaints');
        $role_employee->givePermissionTo('edit_all_shipments');
        $role_employee->givePermissionTo('accept_any_shipment');
        $role_employee->givePermissionTo('view_all_invoices');
        $role_employee->givePermissionTo('view_all_shipments');

        $role_employee_hr->givePermissionTo('view_all_users');
        $role_employee_hr->givePermissionTo('edit_roles');
        $role_employee_hr->givePermissionTo('view_all_roles');
        $role_employee_hr->givePermissionTo('edit_any_user_info');
        $role_employee_hr->givePermissionTo('view_all_employees');
        $role_employee_hr->givePermissionTo('add_vacant_jobs');
        $role_employee_hr->givePermissionTo('edit_vacant_jobs');
        $role_employee_hr->givePermissionTo('edit_any_employee');
        $role_employee_hr->givePermissionTo('change_employee_contracts');
        $role_employee_hr->givePermissionTo('view_employee_count');
        $role_employee_hr->givePermissionTo('add_employee');

        $role_employee_it->givePermissionTo('view_basic_server_info');
        $role_employee_it->givePermissionTo('view_all_permissions');

        $role_user->givePermissionTo('edit_own_user_info');
        $role_user->givePermissionTo('delete_own_user_account');

        $role_management->givePermissionTo('view_employee_count');
        $role_management->givePermissionTo('view_reviews');
        $role_management->givePermissionTo('view_all_shipments');
        $role_management->givePermissionTo('delete_any_shipment');
        $role_management->givePermissionTo('edit_any_review');
        $role_management->givePermissionTo('delete_any_review');
        $role_management->givePermissionTo('edit_any_employee');
        $role_management->givePermissionTo('view_all_orders');

        // Create the minimum required users.
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
        if (! User::query()->where('email', 'management@local.test')->first()) {
            $regular_user = User::query()->create([
                'name' => 'Management',
                'email' => 'management@local.test',
                'email_verified_at' => Carbon::parse('2022-01-01 13:00:00'),
                'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
            ]);
        }

        $admin_user = User::query()->where('email', 'admin@local.test')->first();
        $employee_user = User::query()->where('email', 'employee@local.test')->first();
        $employee_hr_user = User::query()->where('email', 'employee-hr@local.test')->first();
        $employee_it_user = User::query()->where('email', 'employee-it@local.test')->first();
        $regular_user = User::query()->where('email', 'user@local.test')->first();
        $management_user = User::query()->where('email', 'management@local.test')->first();

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

        $management_user->assignRole('management');
        $management_user->assignRole('employee');
        $management_user->assignRole('user');
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
