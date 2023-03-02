## ./factories
Factories can be used to easily seed the database (fill it with random data for testing). The
factories are linked to their corresponding model in \App\Models.

## ./migrations
Migrations describe the evolution of the database schema over time. They are used when the
repository is cloned to a machine to instantly set up the development database, or to set up the
production database. They also allow for easily moving the database to next versions by calling `php
artisan migrate`, which will make sure the schema is always up to date.

## ./seeders
Seeders make use of [the model factories](factories) to fill the database with random data, useful
for testing.
