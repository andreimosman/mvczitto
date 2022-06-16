<?php

use MVCzitto\Routing\Router;

return( 
    function() use ($MVCzitto) {
        $controllersFolder = $MVCzitto->config->app->paths->controllers ?? "controllers";
        return Router::getFilesystemRouter($controllersFolder);
    }
);
