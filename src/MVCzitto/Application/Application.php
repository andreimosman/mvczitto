<?php

namespace MVCzitto\Application;

use MVCzitto\Base\Component;
use MVCzitto\DependencyInjector;

class Application extends Component
{
    protected static $instance;

    protected function __construct()
    {
        $this->init();
    }

    protected function init()
    {
    
    }

    public static function getInstance(?DependencyInjector $di = null): Application
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        if( $di === null && static::$instance::$di == null ) {
            $di = DependencyInjector::getInstance();
            static::$instance->setDI($di);
        }

        return static::$instance;
    }

    public function run()
    {
        //
    }

}
