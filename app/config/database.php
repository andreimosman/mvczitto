<?php

/**
 * This is an exemple configuration depending on the environment.
 */
$dbSettings = [
    'production' => [
        'host' => 'someproductionhost',
        'user' => 'produser',
        'password' => 'prodpass',
        'database' => 'proddb',        
    ],
    'development' => [
        'host' => 'host.docker.internal',
        'user' => 'dev',
        'password' => 'dev',
        'database' => 'dev',
    ],
];

return defined('ENVIRONMENT') && isset($dbSettings[ENVIRONMENT]) ? $dbSettings[ENVIRONMENT] : $dbSettings['development'];
