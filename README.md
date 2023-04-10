# AD

## Branches
Create a seperate branch for every feature you are working on.
For example you are working on database connection, call your branch `db-connection`

When you are done implementing the feature merge your branch with main.
1. make sure to pull the latest changes to main
2. merge main into your branch (not the other way around)

If you want to save yourself a lot of merging work, merge with main occasionally if you are working on a branch for a while.

When this is done create a pull request on github for your branch to be merged into main, if you completed the previous step correctly,
github will tell you that your branch has no conflicts. Wait for someone to accept the pull request

## Cloning the project
After cloning the project, put the following commands in your CLI:
```sh
composer install
npm ci
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
./artisan bootstrap
```

Running `./artisan bootstrap` is done automatically when seeding the database, so it's only required
when not seeding the database (like when deploying the project). Running it multiple times has no
bad effects.

## Running the project
run the following commands in different terminals (!)
1. npm run dev
2. php artisan serve

## Code Formatting
Code formatting is required before a pull request can be merged, to make merging easier for
everyone. The tools required for formatting are automatically installed by npm and Composer.
Currently the following formatters are used:
- Laravel Pint for PHP (Composer)
- Prettier for HTML/JS/CSS/JSON (npm)
- blade-formatter for Blade Templates (npm)

Run the following command to automatically format all code:

```sh
./artisan format
```

To check whether the code in the current directory follows the style, you can add the `--test` flag
to the command, which will prevent changes to the code and only report files that aren't following
the correct style.

> It is possible to install the formatters globally and change the path through environment
> variables (`LARAVEL_PINT_PATH`, `PRETTIER_PATH` and `BLADE_FORMATTER_PATH`).

## Basic user accounts
- admin@local.test
- employee@local.test
- user@local.test

password: `letmein`

## General
- put \<x-app-layout>\</x-app-layout> around your HTML code

