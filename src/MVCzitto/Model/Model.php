<?php

namespace MVCzitto\Model;

use MVCzitto\Base\Component;
use MVCzitto\DependencyInjector;

class Model extends Component
{
    
    protected static $instances = [];

    public $model;
    public $modelFolder;

    private static $defaultModelFolder = './models';

    private function __construct($model, $modelFolder)
    {
        $this->model = $model;
        if( !$modelFolder ) $modelFolder = self::$defaultModelFolder;
        $this->modelFolder = $modelFolder;
    }

    public static function setDefaultModelFolder($modelFolder)
    {
        self::$defaultModelFolder = $modelFolder;
    }

    public static function getInstance($model, $modelFolder = null)
    {
        if (!isset(self::$instances[$model])) {
            self::$instances[$model] = new self($model, $modelFolder);
        }

        return self::$instances[$model];

    }

    public function __call($_NAME, $_PARAMETERS)
    {
        $file = $this->modelFolder . '/' . $this->model . "/" . $_NAME . '.php';

        if( !file_exists($file) ) {
            throw new \ModelNotImplemented('Model file not found: ' . $file);
        }

        $MVCzitto = DependencyInjector::getInstance();
        return include $file;

    }

}
