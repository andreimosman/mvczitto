<?php

namespace MVCzitto;

class DependencyInjector 
{
    private static $instance;
    private $container = [];

    private function __construct()
    {

    }

    public static function getInstance(): DependencyInjector
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function set($key, $value)
    {
        $this->container[$key] = $value;
    }

    public function get($key) : mixed
    {
        return $this->container[$key];
    }

    public function __get($key) : mixed
    {
        return $this->get($key);
    }


}
