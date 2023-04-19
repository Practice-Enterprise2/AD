# Authorization

## How It Works

The authorization has three important concepts: users, roles and permissions.
Users are the same users that are used for authentication, represented by the
`User` model. Roles group users together according to similarity in permissions.
For example, all IT users may be added to a group `it_users`. Permissions are
the most important part of the authorization logic. Permissions can be assigned
to users and roles. An example permission might be `view_all_users`. A user with
this permission or in a group with this permission can view all the users.

Permissions can also grant extra permissions. It solves the problem of having to
define every permission explicitly. For example if some functionality requires
`view_basic_server_info`, but a user has the `view_detailed_server_info`
permission, as long as the last one grants the first one, they will also be able
to access the functionality.

**Users should never directly get permissions**, as it doesn't scale well.
Always assign permissions to roles, and roles to users.

## Defining a New Permission/Role

New permissions/starter roles can be defined in
`App\Providers\AppServiceProvider` under `bootstrap_database`. **Don't forget to
run the Artisan `bootstrap` command** to add everything to the database.

## Extra Information

-   [How to use the authorization functionality](https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage)
-   [Laravel gates](https://laravel.com/docs/10.x/authorization#gates)
