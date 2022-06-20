<?php

require_once("../vendor/autoload.php");
require_once("config.php");

use MVCzitto\Application\WebApplication;

$app = WebApplication::getInstance();
$app->bootstrap();
$app->setLoginRoutePath('/user/login'); // <-- todo: put at config
$app->run();
