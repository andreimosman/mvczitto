<?php

use MVCzitto\View\View;

return( 
    function() use ($MVCzitto) {
        $viewsFolder = $MVCzitto->config->app->paths->views ?? "views";
        return View::getInstance($viewsFolder);
    }
);
