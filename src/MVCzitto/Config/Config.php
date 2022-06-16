<?php

namespace MVCzitto\Config;

use MVCzitto\DependencyInjector;

class Config
{

    private static $instance = null;
    protected $config;

    private function __construct()
    {
        $this->config = new Node([]);
        DependencyInjector::getInstance()->config = $this;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __get($key): mixed
    {
        return $this->config->get($key);
    }

    public static function loadFromFolder($folder)
    {
        $instance = self::getInstance();
        $instance->config = $instance->readConfigFromFolder($folder);
        return($instance);
    }

    public function readConfigFromFolder($folder)
    {
        $configs = [];

        $files = scandir($folder);
        foreach ($files as $file) {
            if( in_array($file, ['.', '..']) ) continue;

            $fileName = $folder . '/' . $file;
            $info = pathinfo($fileName);

            if( is_dir($fileName) ) {
                $configs[$info['filename']] = $this->readConfigFromFolder($fileName);
            } else {
                switch( @$info['extension'] ) {
                    case 'php':
                        $configs[$info['filename']] = Node::fromPHPFile($fileName);
                        // include $fileName;
                        break;
                    case 'ini':
                        $configs[$info['filename']] = Node::fromINIFile($fileName);
                        //parse_ini_file($fileName);
                        break;
                    case 'json':
                        $configs[$info['filename']] = Node::fromJSONFile($fileName);
                        // json_decode(file_get_contents($fileName), true);
                        break;
                    case null:
                        $configs[$info['filename']] = Node::fromRawFile($fileName);
                    default:
                        break;
                }
            }
        }

        return new Node( $configs );
    }

}
