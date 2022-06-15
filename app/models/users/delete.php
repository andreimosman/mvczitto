<?php
/**
 * $_PARAMETERS is an array of parameters passed to the method.
 */

$filter = @$_PARAMETERS[0] ?? [];

// You can access everything you put on DI at entrypoint by using $DI->get('item') or $DI->item. Examples:
// $db = $DI->get('db');
// $mongo = $DI->mongo;

if( !count($filter) )
{
    // Trying to delete all records...

}
