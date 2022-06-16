<?php

use MVCzitto\Model\ModelFactory;


return( 
    function() use ($MVCzitto) {
        print_r($MVCzitto);
        $modelsFolder = $MVCzitto->config->app->paths->models ?? "models";
        return ModelFactory::getInstance($modelsFolder);
    }
);
