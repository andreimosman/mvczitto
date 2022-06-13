<?php

namespace MVCzitto\Application;
use MVCzitto\DependencyInjector;

class WebApplication extends Application
{

    protected $loginRoute = 'login';

    public function setLoginRoutePath($loginRoute)
    {
        $this->loginRoute = $loginRoute;
    }

    public function getLoginRoutePath()
    {
        return $this->loginRoute;
    }

    protected function getUriPath() 
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        return(isset($parts['path']) ? $parts['path'] : '/');
    }

    protected function rebuildVars() 
    {

        $parts = parse_url($_SERVER['REQUEST_URI']);

        if( !isset($parts['query']) ) return;

        parse_str($parts['query'], $query);

        $_GET = array_merge($_GET, $query);
        $_REQUEST = array_merge($_REQUEST, $query);

    }

    protected function init()
    {
        $this->rebuildVars();
        $this->startSession();
    }

    public function startSession()
    {
        if( !isset($_SESSION) ) {
            session_start();
        }
    }

    public function notFound() 
    {
        $route = $this->router->getRouteFor('404');
        if( $route ) $route->dispatch();

        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        
    }

    public function accessDenied(): void
    {
        $route = $this->router->getRouteFor('403');
        if( $route ) $route->dispatch();

        header("HTTP/1.0 403 Access Denied");
        echo "403 Access Denied";

    }

    public function redirectTo($url, $params = []): void
    {
        if( is_countable($params) && count($params) > 0 )
        {
            $url .= "?" . http_build_query($params);
        }
        header("Location: $url");
        exit;
    }


    public function redirectToLogin($params = [])
    {
     
        $route = $this->router->getRouteFor( $this->getLoginRoutePath() );
            
        if( $route == null )
        {
            $this->accessDenied();
            return;
        }

        $redirectTarget = $route->getRoute();

        $this->redirectTo($redirectTarget, $params);
        return;

    }

    public function run()
    {

        DependencyInjector::getInstance()->auth = Authentication::getInstance(); // Generic authentication

        $verb = strtolower($_SERVER['REQUEST_METHOD']);
        $authRouteInfo = Authentication::getInstance()->isAuthenticated() ? 'authenticated' : 'open';

        $route = $this->router->getRouteFor($this->getUriPath(), $verb, $authRouteInfo);

        if( $route === null ) {
            // Probably session has expired
            if( $authRouteInfo == "open" && !($route = $this->router->getRouteFor($this->getUriPath(), $verb, 'authenticated'))) {
                $this->notFound();
                return;                    
            }

            // Some error happening after the user authentication (redirect probably didn't work)
            if( $authRouteInfo == "authenticated" && !$route )
            {
                $this->redirectTo("/");
                return;
            }
            
        }
        
        if( $route->getOptions()?->authentication?->required && Authentication::getInstance()->isAuthenticated() === false ) {
            $this->redirectToLogin([
                'notification_type' => 'info',
                'notification_message' => 'Session has expired. Please login again.',
            ]);
            return;
        }

        $controller = $route->getController();
        return $controller->run();

    }

}
