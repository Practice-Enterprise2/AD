# Database

Only MariaDB is supported.

## ./factories

Factories can be used to easily seed the database (fill it with random data for
testing). The factories are linked to their corresponding model in \App\Models.

## ./migrations

Migrations describe the evolution of the database schema over time. They are
used when the repository is cloned to a machine to instantly set up the
development database, or to set up the production database. They also allow for
easily moving the database to next versions by calling `php artisan migrate`,
which will make sure the schema is always up to date.

To ensure the correctness of database migrations, it can be handy to compare the
schema after a migration with the original one. That can show errors that are
hard to catch in the migration code. Even better is when the schemas are
compared after doing a migration and a rollback of that migration, to ensure the
schema is equal to the original one after the rollback.

To create a visual representation of the database schema, there exists a tool
called `mysqldump` which can dump the SQL commands needed to create the current
schema. Diffing the output of that command with a tool like `colordiff` before
and after migrations is a quick way to highlight errors during development,
before they are pushed upstream.

## ./seeders

Seeders make use of [the model factories](factories) to fill the database with
random data, useful for testing.
