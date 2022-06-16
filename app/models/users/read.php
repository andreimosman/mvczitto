<?php
/**
 * $_PARAMETERS is an array of parameters passed to the method.
 * Everything you load via bootstrap or dependency injector will be available hera as $MVCzitto.
 * Ex: $MVCzitto->view, $MVCzitto->router, $MVCzitto->app, $MVCzitto->auth...
 */

// You can access everything you loaded via bootstrap or dependency injector here as $MVCzitto.
// Using one of the following ways:
// $db = $MVCzitto->get('db');
// $mongo = $MVCzitto->mongo;


$filter = @$_PARAMETERS[0] ?? [];
$options = @$_PARAMETERS[1] ?? []; // Somethinig like order or limit

// Example
$database = [
    [
        'id' => 1,
        'name' => 'Teste User',
        'email' => 'test@test.com',
        'password' => password_hash('1234', PASSWORD_DEFAULT),
    ],
    [
        'id' => 2,
        'name' => 'Teste User 2',
        'email' => 'test2@test.com',
        'password' => password_hash('4321', PASSWORD_DEFAULT),
    ]
];

if( !count($filter) ) return $database;

$recordsFound = array_filter( $database , function($record) use ($filter) {
    return $record['email'] == $filter['email'];
});

return count($recordsFound) > 0 ? $recordsFound[0] : false;
