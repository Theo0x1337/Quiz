Quiz
====

## Installation

1. Create a `.env.local` file at the root of the project
1. Put the following into the file
    ```env
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    ```
1. Install dependencies
    ```shell script
    php composer.phar install
    ```
1. Set up database
    ```shell script
    php bin/console doctrine:database:create # if database doesn't exist
    php bin/console doctrine:migrations:migrate
    ```
