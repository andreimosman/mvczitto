<?php

/**
 * This is part of the demo/skelleton application.
 * 
 * It will show the getting started page.
 * 
 */

$MVCzitto->view->display('open/header');
$MVCzitto->view->display(); // By default it display the view with the same path as the controller
$MVCzitto->view->display('open/footer');
