# hotCoffee Admin Panel

Laravel admin panel package to kick start your new web app.

![alt text](http://dev.taffovelikoff.com/images/hotcoffee/hotcoffee_intro.png "hotCoffee")

[Computer psd created by rawpixel.com - www.freepik.com](https://www.freepik.com/free-photos-vectors/computer)

## What is hotCoffee

-- will add description soon --

#### User Profile
![alt text](http://dev.taffovelikoff.com/images/hotcoffee/profile.png "hotCoffee User Profile")

#### Page Editor
![alt text](http://dev.taffovelikoff.com/images/hotcoffee/page.png "hotCoffee Page Editor")

#### Menu Editor
![alt text](http://dev.taffovelikoff.com/images/hotcoffee/menu.png "hotCoffee Menu Editor")

## Prerequisites

Before installing hotCoffee make sure you have installed Laravel 6 or above and PHP 7.2 or newer.

## Installing

#### STEP 1: Required the package
The installation process is really simple. Create a new Laravel application and include the package with the following command:

```
composer require taffovelikoff/hotcoffee
```

#### STEP 2: Setup the database
Next make sure to create a new database and add your database credentials to the .env file. Also add your application URL in the APP_URL variable:

```
APP_URL=http://127.0.0.1:8000/
DB_HOST=localhost
DB_DATABASE=hotcoffee
DB_USERNAME=root
DB_PASSWORD=mypassword
```

#### STEP 3: Run the installation script
After that you can run an artisan command to finilize the installation.

```
php artisan hotcoffee:install
```

The script will ask you if you want to also install the example logic (this includes some example controllers, routes, views and dummy pages for the front-end of your app). Type "yes" or "no" and hit enter to continue.

#### STEP 4: Extend the User model
Edit your User model (usually app/User.php) and make the class extend \TaffoVelikoff\HotCoffee\User instead of Authenticatable.

```php
<?php

namespace App;


class User extends \TaffoVelikoff\HotCoffee\User
{
	//
}

```

#### STEP 5: Create your first admin user
You can now create your first admin user with a simple artisan command:

```
php artisan hotcoffee:make-admin --name=admin --email=admin@site.com
```

#### STEP 6: Make sure everything went ok
Use php artisan serve to run PHP's built-in development server.
The admin panel should be available on this address (or similar): http://127.0.0.1:8000/admin/login
