<?php
/**
 * $_PARAMETERS is an array of parameters passed to the method.
 * Everything you load via bootstrap or dependency injector will be available hera as $MVCzitto.
 * Ex: $MVCzitto->view, $MVCzitto->router, $MVCzitto->app, $MVCzitto->auth...
 */

$filter = @$_PARAMETERS[0] ?? [];

// You can access everything you loaded via bootstrap or dependency injector here as $MVCzitto.
// Using one of the following ways:
// $db = $MVCzitto->get('db');
// $mongo = $MVCzitto->mongo;

if( !count($filter) )
{
    // Trying to delete all records...

}
