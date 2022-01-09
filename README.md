### To start the app, follow the steps below.

###### 1. Clone repo:

    git clone https://github.com/MarcelDrugi/generators

###### 2. Go to root directory:

    cd generators/generators

###### 3. Install dependencies.
Using composer, in root directory:

    composer install

###### 4. In .env file insert the settings of the database you are using.
Example for MySQL:

    DATABASE_URL="mysql://my_nick:my_password@127.0.0.1:3306/database_name?serverVersion=5.7"

###### 5. Create DB, create migrations and run it:

    php bin/console doctrine:database:create
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate



###### 6. Check if the application works by starting the server:

    php -S 127.0.0.1:8005 -t public

If you haven't changed the settings, the application should start at: http://127.0.0.1:8005

Of course you can use another server (e.g. Apache 2).

