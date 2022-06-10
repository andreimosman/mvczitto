<?php

namespace MVCzitto\Routing;


class Router 
{

    protected $route;
    protected $staticRoutes = [
        "open" => [],
        "authenticated" => [],
    ];
    protected $regexRoutes = [
        "open" => [],
        "authenticated" => [],
    ];


    private function __construct(mixed $options = null)
    { 

    }

    public static function getFilesystemRouter($folder): Router
    {
        return FileSystem\Router::getInstance($folder);
    }


    public function addRoute(Route $route): void
    {
        $regex = $route->getRegularExpression();
        $this->routes[] = $route;

        if( $regex ) 
        {
            $this->regexRoutes[$route->getAuth()][] = $route;
        }
        else
        {
            $this->staticRoutes[$route->getAuth()][$route->getVerb() . "@" . $route->getRoute()] = $route;
        }
        
    }

    public function getStaticRouteFor($uri, $verb = 'get', $auth = 'open'): ?Route
    {

        $id = $verb . "@" . $uri;
        if( isset($this->staticRoutes[$auth][$id]) ) return $this->staticRoutes[$auth][$id];
        
        return null;

    }

    public function getRegexRouteFor($uri, $verb = 'get', $auth = 'open'): ?Route
    {

        $data = $verb . '@' . $uri;

        foreach($this->regexRoutes[$auth] as $route)
        {
            $regex = "/" . $verb . '@' . $route->getRegularExpression() . "/";

            if( preg_match($regex, $data, $matches) )
            {
                return $route;
            }
        
        }

        return null;

    }

    public function getRouteFor($uri,$verb='get',$auth='open') : ?Route
    {
        $uri = trim($uri);

        $route = $this->getStaticRouteFor($uri,$verb, $auth);
        if( !$route ) $this->getStaticRouteFor($uri . "/index", $verb, $auth) ;
        if( !$route ) return $this->getRegexRouteFor($uri, $verb, $auth);

        return $route;

    }

}