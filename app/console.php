<?php
/**
 * Command Line Interface for MVCzitto application
 */

require_once( __DIR__ . "/../vendor/autoload.php" );
require_once( __DIR__ . "/config.php");

if( 'CONSOLE' != APP_TYPE ) {
    echo "This script can only be run from the command line.";
    exit;
}

use MVCzitto\Application\ConsoleApplication;

$app = ConsoleApplication::getInstance();
$app->bootstrap();
$app->run();

