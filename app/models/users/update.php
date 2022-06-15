<?php
/**
 * $_PARAMETERS is an array of parameters passed to the method.
 * DepentencyInjector is available as $DI;
 */

$filter = @$_PARAMETERS[0] ?? []; // Data to filter/where
$data = @$_PARAMETERS[1] ?? []; // Data to update

// You can access everything you put on DI at entrypoint by using $DI->get('item') or $DI->item. Examples:
// $db = $DI->get('db');
// $mongo = $DI->mongo;

