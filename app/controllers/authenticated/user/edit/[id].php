<?php

// VARS OBTAINED BY THE URL CAN BE ACCESSED AT $_ROUTE['varname'] or $route->getVariables()['varname']

$id = $_ROUTE['id'];

$view = $MVCzitto->view;

$view->assign('id', $id);

$view->display('authenticated/header');
$view->display(); // By default the view will be the same name as the controller.
$view->display('authenticated/footer');
