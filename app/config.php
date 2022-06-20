<?php

use MVCzitto\Config\Config;

if( !defined('ENVIRONMENT') ) define('ENVIRONMENT', 'development');
ENVIRONMENT == 'development' ?? ini_set('display_errors', 1);

define('APP_PATH', __DIR__);
$config = Config::loadFromFolder(APP_PATH.'/config');

if( php_sapi_name() == 'cli' ) 
{
    define('APP_TYPE', 'CONSOLE');
}
else
{
    
    define('APP_TYPE', 'WEB');

    $uriFolder = trim( substr(dirname($_SERVER['DOCUMENT_URI']),1) );
    $config->app->baseurl = $config->app->baseurl ?: (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . ($uriFolder ? '/' . $uriFolder : '');
    define('BASE_URL', $config->app->baseurl);
    
}


