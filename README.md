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
1. composer install
2. npm ci
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate --seed

## Running the project
run the following commands in different terminals (!)
1. npm run dev
2. php artisan serve

## Automatic Style Fixes
To preserve a consistent style accross the codebase, it is recommended to run [Laravel
Pint](https://laravel.com/docs/10.x/pint) before every pull request or other upstream merge. To do
this, run the following from the project root:

```sh
./artisan format
```

To check whether the code in the current directory follows the style, you can add the `--test` flag
to the command. That will prevent changes to the code and only report files that aren't following
the correct style.

## Basic user accounts
- admin@local.test
- employee@local.test
- user@local.test

password: `letmein`

## General
- put \<x-app-layout>\</x-app-layout> around your HTML code

