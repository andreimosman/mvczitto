<?php
/**
 * $_PARAMETERS is an array of parameters passed to the method.
 * DepentencyInjector is available as $DI;
 */

$data = @$_PARAMETERS[1] ?? []; // Data to insert

// You can access everything you put on DI at entrypoint by using $DI->get('item') or $DI->item. Examples:
// $db = $DI->get('db');
// $mongo = $DI->mongo;


