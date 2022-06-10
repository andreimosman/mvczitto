# MVCzitto

This is a very small MVC framework for PHP that uses filesystem routing for controllers and views.


The idea behing this is to write code using PHP as pure as possible, but providing some patterns and organization.

Two things motivated me to do it:
 - The nextjs routing
 - Rasmus Lerdorf "PHP Frameworks all suck" phrase =)

 
## HOWTO


# Add via composer

```
composer require andreimosman/mvczitto
```

# Create your app structure such as:

```
├── controllers
│   ├── authenticated
│   │   ├── dashboard
│   │   │   └── index.php
│   │   └── user
│   │       ├── @(post)new.php
│   │       ├── edit
│   │       │   ├── @(put,patch)[id].php
│   │       │   └── [id].php
│   │       ├── logout.php
│   │       ├── new.php
│   │       └── profile.php
│   └── open
│       ├── index.php
│       └── user
│           ├── index.php
│           └── login.php
├── index.php
└── views
    └── open
        └── user
            └── login.php
```

### Verbs


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

### The main index.php

To test you can use the code bellow:
```
<?php

require_once("./vendor/autoload.php");

use MVCzitto\Routing\Router;
use MVCzitto\DependencyInjector;
use MVCzitto\Application\WebApplication;
use MVCzitto\View\View;

$di = DependencyInjector::getInstance();

$viewsFolder = "views";
$di->set("view", View::getInstance($viewsFolder) );

$controllersFolder = "controllers";
$di->set("router", Router::getFilesystemRouter($controllersFolder) );

$app = WebApplication::getInstance();
$di->set("app", $app);

$app->setLoginRoutePath('/user/login');
$app->run();

```

###

*** TO FINISH ***
