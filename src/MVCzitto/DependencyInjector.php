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

    public function getContainer(): array
    {
        return $this->container;
    }

    public function set($key, $value)
    {
        $this->container[$key] = $value;
    }

    public function get($key) : mixed
    {
        return is_callable($this->container[$key]) ? $this->container[$key]() : $this->container[$key];
    }

    public function __get($key) : mixed
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }


}
