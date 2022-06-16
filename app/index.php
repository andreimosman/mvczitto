<?php

require_once("../vendor/autoload.php");

use MVCzitto\Config\Config;
use MVCzitto\DependencyInjector;
use MVCzitto\Application\WebApplication;

define('ENVIRONMENT', 'development');
ENVIRONMENT == 'development' ?? ini_set('display_errors', 1);

define('APP_PATH', __DIR__);
$config = Config::loadFromFolder(APP_PATH.'/config');
$uriFolder = trim( substr(dirname($_SERVER['DOCUMENT_URI']),1) );

$config->app->baseurl = $config->app->baseurl ?: (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . ($uriFolder ? '/' . $uriFolder : '');
define('BASE_URL', $config->app->baseurl);

$app = WebApplication::getInstance();
$app->bootstrap();
$app->setLoginRoutePath('/user/login'); // <-- todo: put at config
$app->run();
