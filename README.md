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
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate

## Running the project
run the following commands in different terminals (!)
1. 'npm run dev'
2. 'php artisan serve'

## Creating your own page
1. Extend your page from the header -> @extends('layouts.header')
2. Start section -> @section('content')
This will be put under the header on the page. (you can see the content div in layouts/header)
3. insert your html code (no need for body, can be just div. Kinda like a component)
4. end your section with @endsection
5. add route for your page and optionally link it in header


 

