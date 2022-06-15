<?php
/**
 * MVCzitto example.
 * 
 * This controller handles POST to /user/login.
 * 
 * You can use almost raw PHP here
 */

// Everything added to DependencyInjector is available in the controller. Including:
// $view, $router, $app and $auth

$email = @$_REQUEST['email'];
$password = @$_REQUEST['password'];

// $usersModel = $models->get('users');
$usersModel = $models->users;
$user = $usersModel->read(['email' => $email]);

if( $user )
{
    if( password_verify($password, $user['password']) )
    {
        unset($user['password']); // Do not store password hash in session.
        $auth->setAuthenticationData($user);
        $app->redirectTo('/');
        return;
    }

}

/**
 * User was not authenticated. It's time to redirect to the login page with an error message.
 */

$app->redirectToLogin(
    [
        'email' => $email,
        'notification_type' => 'error',
        'notification_message' => 'Invalid email or password.',
    ]
);
