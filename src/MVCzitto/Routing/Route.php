<?php

namespace MVCzitto\Routing;

use MVCzitto\Controller\Controller;
use MVCzitto\Controller\ControllerAdapter;

use \MVCzitto\Routing\Route as BaseRoute;

class Route implements ControllerAdapter
{
    private $verb, $auth, $route, $target, $options, $regex;
    private $hasRegex = true;

    protected function __construct($verb, $auth, $route, $target, $options = [])
    {
        $this->verb = $verb;
        $this->auth = $auth;
        $this->route = $route;
        $this->target = $target;
        $this->options = $options;
    }

    public static function create($verb, $auth, $route, $target, $options = []): Route
    {
        return new Route($verb, $auth, $route, $target, $options);
    }

    public function getVerb(): string
    {
        return $this->verb;
    }

    public function getAuth(): string
    {
        return $this->auth;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getOptions(): ?object
    {
        if( is_array($this->options) ) {
            $this->options = count($this->options) ? json_decode(json_encode($this->options)) : null;
        } 
        return $this->options;
    }

    public function getRegularExpression()
    {
        if( !$this->hasRegex ) return null;
       
        if (!preg_match("/:[^\\/]+/", $this->route)) {
            $this->hasRegex = false;
            return null;
        }

        if( $this->regex ) return $this->regex;

        $this->regex = str_replace("/","\\/", $this->route);
        $this->regex = preg_replace("/:[^\/]+/", "([^\/]+)", $this->regex);

        return $this->regex;

    }

    public function getSuggestedTemplate() 
    {
        return "/" . $this->getAuth() . "/" . $this->getRoute();
    }

    public function executable(): \Closure
    {
        return \Closure::fromCallable(
            function () {
                // Dummy
            }
        );
    }


    public function getController(): Controller
    {
        return Controller::create($this);
    }


}
