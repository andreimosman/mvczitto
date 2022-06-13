<?php

$view->assignAllVariablesInArray($_REQUEST); // Every variable in $_REQUEST will be available in the view as $varname.

$view->display('open/header');
$view->display();
$view->display('open/footer');
