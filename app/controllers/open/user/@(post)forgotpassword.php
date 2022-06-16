<?php
// This page should do the magic of sending an email to the user with a link to reset his password.

$email = @$_REQUEST['email'];

$params = [];

if( $email )
{
    // Do the magic
    $params = [
        'email' => $email,
        'notification_type' => 'success',
        'notification_message' => 'An email has been sent to you with a link to reset your password.',
    ];
    
}

$MVCzitto->app->redirectTo('/user/forgotpassword', $params);

