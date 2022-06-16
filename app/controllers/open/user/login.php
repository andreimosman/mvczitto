<?php

// Everything you load via bootstrap or dependency injector will be available hera as $MVCzitto.
// Ex: $MVCzitto->view, $MVCzitto->router, $MVCzitto->app, $MVCzitto->auth...
// If you put a class on the DependencyInjector, it will be available here.

// Send variables to the view
// $view->assign('name', 'John');

$view = $MVCzitto->view;

$view->assignAllVariablesInArray($_REQUEST); // Every variable in $_REQUEST will be available in the view as $varname.

$view->display('open/header');
$view->display();
$view->display('open/footer');

