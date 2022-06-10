<?php

namespace MVCzitto\View;

use MVCzitto\Base\Component;

class View extends Component
{
    protected static $instance;
    protected $path;

    protected $vars = [];

    public static function getInstance(?string $path)
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        if( $path ) static::$instance->path = $path;

        return static::$instance;
        
    }

    public function assign(string $name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function getSuggestedTemplate() {

        if( $this->route === null ) return null;

        return $this->route->getSuggestedTemplate();
    }

    public function render(?string $template = null)
    {


        if( $template ) {
            $templatePath = $this->path . '/' . $template . '.php';
        } else {
            if( !$template ) $template = $this->getSuggestedTemplate();
            if( !$template ) return null;

            $templatePath = $template;

        }
        
        if( !file_exists($templatePath) ) {
            throw new \Exception('Template not found: ' . $templatePath);
        }

        extract($this->vars);
        ob_start();
        include $templatePath;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }


    public function display(?string $template = null)
    {
        echo $this->render($template);
    }

}
