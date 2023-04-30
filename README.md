# AD

## How to Add Code

1. Fork the project using the 'Fork' button on GitHub
2. Clone the forked repository to your PC
3. Create a new branch in the local repository on your PC
4. Add commits to the branch until your feature/bugfix is done
5. Go to your fork on GitHub or the upstream repository
6. Click the notification that asks you to create a pull request
7. **Request a review on the pull request's page**

There are normal and draft pull requests. Normal pull requests should be
finished and should be able to be merged after minimal changes requested in a
review. Draft pull requests are nice to show what you're working on and don't
need to be finished. They can later be changed into normal ones when the code is
ready. It is possible to edit pull requests after they have been made. Just push
new commits to the corresponding branch and the pull request will update with
it.

## Pull Request Requirements

-   Don't edit migration files

    > Editing migration files has the same effect as Git force pushing. It
    > changes history, which won't be visible for others.

-   Format using the Artisan format command

    > Formatting the code before every pull requests helps keep the codebase
    > clean for everyone, and it also greatly simplifies merging, both from and
    > to upstream.

-   Don't update package/lock files

    > Updating packages and lock files has to happen from time to time, but it's
    > not a small change. It should always be done in separate commits with
    > their own pull requests, not together with another change. Installing new
    > packages however is fine.

-   Write correct rollback implementations for migrations (`down()` method)

    > Migrations that don't have a correct rollback implementation can't easily
    > be undone, which prevents people from making an easy transition to new
    > database versions.

-   Don't leave commented code around

    > Commenting out code is nice during development, but has no meaning to
    > other people. It should either be removed, or replaced by a single comment
    > explaining a todo, like `// TODO: Implement put method for controller`.

-   Don't use raw CSS for layouts and components, use TailwindCSS

    > Using raw CSS can cause confusion when others make use of your
    > component/layout as it will mess with all the classes on the page, not
    > just the file it's defined in.

These requirements are hard rules. Pull requests that don't check these cannot
be merged. They are meant to help everyone by keeping upstream functional and
nice to work with.

## Getting Started After Cloning

After cloning the project, put the following commands in your CLI:

```sh
composer install
npm ci
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan bootstrap
```

Running `./artisan bootstrap` is done automatically when seeding the database,
so it's only required when not seeding the database (like when deploying the
project). Running it multiple times has no bad effects.

## Running the project

```sh
# Run these in different terminals
npm run dev
php artisan serve
php artisan websockets:serve
```

## Code Formatting

Code formatting is required before a pull request can be merged, to make merging
easier for everyone. The tools required for formatting are automatically
installed by npm and Composer. Currently the following formatters are used:

-   Laravel Pint for PHP (Composer)
-   Prettier for HTML/JS/CSS/JSON (npm)
-   blade-formatter for Blade Templates (npm)

Run the following command to automatically format all code:

```sh
php artisan format
```

To check whether the code in the current directory follows the style, you can
add the `--test` flag to the command, which will prevent changes to the code and
only report files that aren't following the correct style.

> It is possible to install the formatters globally and change the path through
> environment variables (`LARAVEL_PINT_PATH`, `PRETTIER_PATH` and
> `BLADE_FORMATTER_PATH`).

## Static Code Analysis

Static code analysis is available and can be run using the following commands.
It helps to prevent common errors and suggests improvements.

```sh
# Run all the tools below
php artisan clippy

# Run Psalm on all PHP files
php ./vendor/bin/psalm
```

> It is possible to install the tools globally and change the path through
> environment variables.

## Basic user accounts

-   admin@local.test
-   employee@local.test
-   employee-hr@local.test
-   employee-it@local.test
-   user@local.test

password: `letmein`

## General

-   put \<x-app-layout>\</x-app-layout> around your HTML code

## Mail

It is recommended to use port 587 for mail as it is the port for encrypted email
transmissions using SMTP Secure(SMTPS).

If you want to be able to mail please make sure your .env file has the following
lines of code:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=redbeastpro18@gmail.com
MAIL_PASSWORD=jvaflujkltwmvlzu
MAIL_ENCRYPTION=tsl
MAIL_FROM_ADDRESS="redbeastpro18@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```
