# You Library

## Set up the project

* Clone the project

```
  git clone https://github.com/DubMan21/You-Library.git
```
Then move in.

* Install dependencies

```
  composer install
```

* Install javascript dependencies

```
  yarn install
```

* Create a .env.local file with the content as the .env file. Define the url of your database by uncommenting the corresponding line and fill it with your values 

```
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
```

* Create the database with doctrine
```
  php bin/console doctrine:database:create
```

* Migrate the database
```
  php bin/console doctrine:migrations:migrate
```

* Start the server
```
  symfony server:start
```

* Compile assets

```
  yarn encore dev --watch
```

You can access it on [https://127.0.0.1:8000](https://127.0.0.1:8000)

## Use

* Create a user with a symfony command. You must fill in the user's `email` and `password`. You can create an admin user instead of a regular user with the `--admin` flag.

```
  php bin/console app:create-user email password --admin
```