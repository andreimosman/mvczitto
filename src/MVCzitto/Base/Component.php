<?php

namespace MVCzitto\Base;

use MVCzitto\DependencyInjector;

class Component
{
    protected static $di;

    public static function setDI(?DependencyInjector $di): void
    {
        if( !$di ) $di = DependencyInjector::getInstance();
        self::$di = $di;
    }

    public function __get(string $name) : mixed
    {
        return self::$di->get($name);
    }
    

}
