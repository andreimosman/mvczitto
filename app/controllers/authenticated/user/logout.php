<?php

// Just unset the user authentication data and redirect to login page.

$MVCzitto->auth->unsetAuthenticationData();
$MVCzitto->app->redirectToLogin([
    'notification_type' => 'info',
    'notification_message' => 'Session closed.',
]);
