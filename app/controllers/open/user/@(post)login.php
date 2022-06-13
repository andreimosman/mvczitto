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

if( $email == 'test@test.com' && $password == '1234' )
{
    // This is just a sample, you can use any kind of authentication system.
    // You can get this data from database, for example.
    $data = [
        'id' => 1,
        'email' => $email,
    ];

    /**
     * $auth is an instance of MVCzitto\Application\Authentication.
     */

    // Save the data in the session -> by doing this the user will be reconized as authenticated by the routing system.
    $auth->setAuthenticationData($data);

    $app->redirectTo('/');

    return;
    
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
