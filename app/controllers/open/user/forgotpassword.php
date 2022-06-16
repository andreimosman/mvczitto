<?php

$MVCzitto->view->assignAllVariablesInArray($_REQUEST); // Every variable in $_REQUEST will be available in the view as $varname.

$MVCzitto->view->display('open/header');
$MVCzitto->view->display(); // By default it display the view with the same path as the controller
$MVCzitto->view->display('open/footer');
