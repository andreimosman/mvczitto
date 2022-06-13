<?php

// Everything you put on the DependencyInjector will be available here.
// Ex: $view, $router, $app, $auth...
// If you put a class on the DependencyInjector, it will be available here.

// Send variables to the view
// $view->assign('name', 'John');

$view->assignAllVariablesInArray($_REQUEST); // Every variable in $_REQUEST will be available in the view as $varname.

$view->display('open/header');
$view->display();
$view->display('open/footer');

