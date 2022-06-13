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

        $routeSignature = $route->getVerb() . "@" . $route->getRoute();

        if( $regex ) 
        {
            $this->regexRoutes[$route->getAuth()][$routeSignature] = $route;
        }
        else
        {
            $this->staticRoutes[$route->getAuth()][$routeSignature] = $route;
        }
        
    }

    public static function normalizeUri(string $uri): string
    {
        $normalizedUri = strtolower($uri);
        $normalizedUri = str_replace("../", "/", $normalizedUri);
        $normalizedUri = preg_replace("/[\/]+/", "/", $normalizedUri);
        return $normalizedUri;
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

        foreach($this->regexRoutes[$auth] as $routeSignature => $route)
        {
            $regex = "/" .$route->getVerb() . '@' . $route->getRegularExpression() . "(\/index)*\$/";

            if( preg_match($regex, $data, $matches) )
            {
                $variableValues = array_slice($matches, 1);
                // if last element is /index remove it
                if( $variableValues[count($variableValues) - 1] == "/index" ) array_pop($variableValues);

                $route->insertVariableValuesFromList($variableValues);

                return $route;
            }
        
        }

        return null;

    }

    public function getRouteFor($uri,$verb='get',$auth='open') : ?Route
    {
        $uri = trim($uri);

        $route = $this->getStaticRouteFor($uri,$verb, $auth);
        if( !$route ) return $this->getRegexRouteFor($uri, $verb, $auth);

        return $route;

    }

}