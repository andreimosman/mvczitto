<?php

namespace MVCzitto\Routing\FileSystem;

use MVCzitto\Routing\Router as BaseRouter;

class Router extends BaseRouter 
{

    private static $instances;

    protected $folder;
    protected $routes;

    private function __construct($folder) 
    {
        $this->folder = realpath($folder);
        $this->loadRoutesFromFolder();
    }

    public static function getInstance($folder)
    {
        if (!isset(self::$instances[$folder])) {
            self::$instances[$folder] = new self($folder);
        }
        return self::$instances[$folder];
    }

    protected function loadRoutesFromFolder($folder = "")
    {
        if( !$folder ) {
            $this->routes = [];
            $folder = $this->folder;
        }

        $routes = [];

        $dh = opendir($folder);
    
        while(false !== ($file = readdir($dh))) 
        {
            if( in_array($file, ['.', '..']) ) continue;
    
            if(is_dir($folder . "/" . $file)) 
            {
                // array_push($routes, ...$this->loadRoutesFromFolder($folder . "/" . $file));
                $this->loadRoutesFromFolder($folder . "/" . $file);
            } 
            else 
            {
                // array_push($routes, ...$this->createRoutes($folder . "/" . $file));

                $this->addRoutesFromPath($folder . "/" . $file);
            }
    
        }
    
        return $routes;
    
    }

    
    protected function addRoutesFromPath($path, $verbs = ['get'])
    {
        $path = substr($path, strlen($this->folder));
        
        if( !preg_match('/\/(authenticated|open)\/(.+)\.php/', $path, $matches) ) return [];
       
        $routes = [];
        $options = [];

        $auth = $matches[1];

        if( $auth == "authenticated" ) $options["authentication"] = ["required" => true];

        $target = str_replace('//', '/',$this->folder."/".$path); // The file should be included.

        $route = "";
        $partsOfThePath = explode("/", $matches[2]);

        $variables = [];

        foreach($partsOfThePath as $part)
        {

            if( preg_match('/@\((.+)\)(.*)/', $part, $matches) )
            {
                $verbs = explode(",", $matches[1]);
                $part = $matches[2];
            }

            if( preg_match('/\[(.+)\]/', $part, $matches) )
            {
                // It's a variable
                $variable = $matches[1];
                $variables[] = $variable;
                $route .= "/:$variable";
            } 
            else 
            {
                // It's a static part of the route
                $route .= "/$part";
            }
            
        }

        if( count($variables) > 0 ) $options["variables"] = $variables;

        foreach($verbs as $verb)
        { 
            $this->addRoute(Route::create($verb, $auth, $route, $target, $options));
        }
    }

}
