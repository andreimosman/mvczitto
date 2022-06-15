<?php

namespace MVCzitto\Model;

use MVCzitto\Base\Component;
use MVCzitto\DependencyInjector;

class ModelFactory
{
    private static $instances = [];

    private $folder;

    private function __construct($folder)
    {
        $this->folder = realpath($folder);
    }

    public static function getInstance($folder)
    {
        if (!isset(self::$instances[$folder])) {
            self::$instances[$folder] = new self($folder);
        }

        return self::$instances[$folder];
    }
    
    public function get($model): Model
    {
        return Model::getInstance($model, $this->folder);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

}
