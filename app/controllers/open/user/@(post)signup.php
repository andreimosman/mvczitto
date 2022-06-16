<?php

$params = [
    'notification_type' => 'success',
    'notification_message' => 'Your account has been created...',
];

$MVCzitto->app->redirectTo('/user/login', $params);

