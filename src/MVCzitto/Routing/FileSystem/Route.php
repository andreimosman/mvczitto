<?php

namespace MVCzitto\Routing\FileSystem;

use \MVCzitto\DependencyInjector;
use \MVCzitto\Routing\Route as BaseRoute;


class Route extends BaseRoute
{

    protected function __construct($verb, $auth, $route, $target, $options = [])
    {
        parent::__construct($verb, $auth, $route, $target, $options);
    }


    public static function create($verb, $auth, $route, $target, $options = []): Route
    {
        return new Route($verb, $auth, $route, $target, $options);
    }

    public function getSuggestedTemplate() 
    {
        return str_replace("/controllers/", "/views/", $this->getTarget());
    }


    public function executable(): \Closure
    {
        $target = $this->getTarget();
        $_ROUTE = $this->getVariables();
        return \Closure::fromCallable(
            function (mixed $varsToGlobalize = []) use($target,$_ROUTE) {
                extract($varsToGlobalize);
                include($target);
            }
        );
    }



}