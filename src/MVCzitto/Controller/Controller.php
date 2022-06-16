<?php

namespace MVCzitto\Controller;

use MVCzitto\Base\Component;
use MVCzitto\DependencyInjector;
use MVCzitto\Model\Model;

class Controller extends Component
{
    protected $adapter;
    
    private function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        
    }

    public function execute()
    {

    }

    protected function setAdapter(ControllerAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public static function create(ControllerAdapter $adapter): Controller
    {
        $controller = new Controller();
        $controller->setAdapter($adapter);

        return $controller;

    }

    public function run()
    {

        DependencyInjector::getInstance()->set('route', $this->adapter);
        $r = $this->adapter->executable()->call($this, ['MVCzitto' => DependencyInjector::getInstance()] );
        DependencyInjector::getInstance()->set('route', null);
        
    }

}
