# MVCzitto
[![Latest Stable Version](https://img.shields.io/packagist/v/andreimosman/mvczitto.svg?style=flat-square)](https://packagist.org/packages/andreimosman/mvczitto)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg?style=flat-square)](https://php.net/)

MVCzitto is a framework for PHP that allows you to build web applications in a simple and easy way.

Instead of traditional OO Based MVC, we decided to implement MVC using File System Routing. 

The idea behing this is to write code using PHP as pure as possible, but providing some patterns and organization.

Two things motivated me to do it:
 - The nextjs routing
 - Rasmus Lerdorf said "PHP Frameworks all suck". I'm trying to create this fremework as less frameworky as possible.

## HOWTO


### Add via composer

```
composer create-project andreimosman/mvczitto foldername
```

Please refer to the [Composer](https://getcomposer.org/) website for instructions on how to install it on your platform if you don't have it.
Alternatively, you may also download Frameworkitto from the [releases page](https://github.com/andreimosman/mvczitto/releases) and export it to your project's main folder.

### Docker development environment

At the folder `docker-dev-environment` you can call `firstrun.sh` to create the development environment using docker compose.

Please refer to the [Docker](https://www.docker.com/get-started) website for instructions on how to install it on your platform if you don't have it.

## Getting Started with MVCzitto

### The app folder contain more instructions and also few samples

```
app
├── index.php (entry point - where de dependency injection is done)
├── config.php (configuration file)
├── assets
│   ├── css
│   │   └── style.css
│   └── images
│       └── logo-mvczitto.png
├── controllers
│   ├── authenticated (controllers that require authentication)
│   │   ├── dashboard
│   │   │   └── index.php
│   │   ├── index.php
│   │   └── user
│   │       ├── @(post)new.php
│   │       ├── edit
│   │       │   ├── @(put,patch)[id].php
│   │       │   └── [id].php
│   │       ├── logout.php
│   │       ├── new.php
│   │       └── profile.php
│   └── open (controllers that don't require authentication)
│       ├── gettingstarted
│       │   └── index.php
│       ├── index.php
│       └── user
│           ├── @(post)forgotpassword.php
│           ├── @(post)login.php
│           ├── @(post)signup.php
│           ├── forgotpassword.php
│           ├── index.php
│           ├── login.php
│           └── signup.php
├── models (filesystem base models)
│   └── users
│       ├── create.php
│       ├── delete.php
│       ├── read.php
│       └── update.php
└── views (follows the same pattern as controllers)
    ├── authenticated
    │   ├── footer.php
    │   ├── header.php
    │   └── user
    │       └── edit
    │           └── [id].php
    └── open
        ├── footer.php
        ├── gettingstarted
        │   └── index.php
        ├── header.php
        └── user
            ├── forgotpassword.php
            ├── login.php
            └── signup.php
```

### Routing verbs

The verb set by default is ``GET`` but you can specify the verb at the begining of the filename inside ``@()``, such as ``@(post)new.php``


### Authentication

The folders ``authenticated`` and ``open`` means that the route is valid on user is authenticated or not respectively.

The super simple authentication schema is:

```
$auth = \MVCzitto\Application\Authentication::getInstance()

$somethingNotNull = "WHAT EVER YOU WANT. OBJECTS, ARRAYS, STRINGS";
$auth->setAuthenticationData($somethingNotNull);
```

By doing this ```$auth->isAuthenticated()``` will return true;

You can logout by calling ```$auth->unsetAuthenticationData()```

Check `app/controllers/open/user/@(post)login.php` and `app/controllers/authenticated/user/logout.php`

### File system models

```
├── models
    └── users
        ├── create.php
        ├── delete.php
        ├── read.php
        └── update.php
```
To access then on controllers you can just call `$models->nameOfTheController`. Check `app/controllers/open/user/@(post)login.php`:

```
$usersModel = $models->users; // Load the model
$user = $usersModel->read(['email' => $email]); // Find the user
```

It executes the snippet located at `app/models/users/read.php`.

### The main index.php

`app/index.php` contains the entry point of the application and the dependency injector.

