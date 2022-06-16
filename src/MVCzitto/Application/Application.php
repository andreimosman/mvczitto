<?php

namespace MVCzitto\Application;

use MVCzitto\Base\Component;
use MVCzitto\DependencyInjector;

class Application extends Component
{
    protected static $instance;

    protected $mainBootstrapFolder = 'bootstrap';
    protected $bootstrapFoldersToRead = ['common'];

    protected function __construct()
    {

        DependencyInjector::getInstance()->app = $this;
        $this->init();

    }

    protected function init()
    {
    
    }

    public function readBootstrapFolders()
    {

        foreach ($this->bootstrapFoldersToRead as $folder) {
            $MVCzitto = DependencyInjector::getInstance();

            $folderName = $this->mainBootstrapFolder . '/' . $folder;
            $files = scandir($folderName);
            foreach ($files as $file) {
                $fileName = $folderName . '/' . $file;
                if (is_file($fileName)) {
                    $info = pathinfo($fileName);
                    if( $info['extension'] == 'php' ) {
                        $bootstrap = include $fileName;
                        DependencyInjector::getInstance()->set($info['filename'], $bootstrap);
                    }
                }
            }

        }

    }

    public function bootstrap($mainBootstrapFolder = null)
    {

        if( $mainBootstrapFolder !== null ) {
            $this->mainBootstrapFolder = $mainBootstrapFolder;
        } else {
            $this->mainBootstrapFolder = DependencyInjector::getInstance()->config->app->paths->bootstrap ?? 'bootstrap';
        }

        $this->readBootstrapFolders();
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
