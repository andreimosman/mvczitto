<?php

// Just unset the user authentication data and redirect to login page.

$auth->unsetAuthenticationData();
$app->redirectToLogin([
    'notification_type' => 'info',
    'notification_message' => 'Session closed.',
]);
