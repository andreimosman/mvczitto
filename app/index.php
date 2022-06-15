<?php

require_once("../vendor/autoload.php");

ini_set('display_errors', 1);

use MVCzitto\Routing\Router;
use MVCzitto\DependencyInjector;
use MVCzitto\Application\WebApplication;
use MVCzitto\View\View;
use MVCzitto\Model\ModelFactory;

$_CONFIG = include('config.php');
$_CONFIG['BASE_URL'] ?: (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . "/" . substr(dirname($_SERVER['DOCUMENT_URI']),1);
define('BASE_URL', $_CONFIG['BASE_URL']);

$di = DependencyInjector::getInstance();

$viewsFolder = "views";
$di->view = View::getInstance($viewsFolder);

$controllersFolder = "controllers";
$di->router = Router::getFilesystemRouter($controllersFolder);

$modelsFolder = "models";
$di->models = ModelFactory::getInstance($modelsFolder);


$app = WebApplication::getInstance();
$di->app = $app;

$app->setLoginRoutePath('/user/login');

$app->run();
