<?php

namespace MVczitto\Application;

use MVCzitto\Base\Component;
use MVCzitto\DependencyInjector;

class Authentication extends Component
{
    protected static $instance;

    protected $authData;

    protected function __construct()
    {
        $authData = [];
        $this->loadAuthenticationDataFromSession();
    }

    public static function getInstance(?DependencyInjector $di = null): Authentication
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        if( $di !== null ) {
            static::$instance->setDI($di);
        }

        return static::$instance;
    }

    protected function loadAuthenticationDataFromSession()
    {
        $this->authData = null;
        if( isset($_SESSION['__AUTH_DATA__']) ) $this->authData = $_SESSION['__AUTH_DATA__'];

    }

    public function getAuthenticationData(): ?array
    {
        return $this->authData;
    }

    public function setAuthenticationData($data): void
    {
        $this->authData = $data;
        $_SESSION['__AUTH_DATA__'] = $data;
    }

    public function unsetAuthenticationData(): void
    {
        $this->authData = null;
        unset($_SESSION['__AUTH_DATA__']);
    }

    public function isAuthenticated(): bool
    {
        return $this->authData !== null;
    }

}
