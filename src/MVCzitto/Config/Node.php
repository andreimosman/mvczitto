<?php

namespace MVCzitto\Config;

class Node 
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function openIfLastOrNodeIfNot()
    {
        if( $this->content instanceof Node ) return $this;
        if( is_array($this->content) && reset($this->content) instanceof Node ) return $this;
        return $this->content;
    }

    public function get($key)
    {

        if(is_array($this->content) ) {
            if( array_key_exists($key, $this->content) ) {
                return $this->content[$key]->openIfLastOrNodeIfNot();
            }
        }

        return null;

    }

    public function __get($key) : mixed
    {
        return $this->get($key);
    }

    public static function fromPHPFile($file)
    {
        return new Node(include $file);
    }

    public static function fromINIFile($file)
    {
        return new Node(parse_ini_file($file));
    }

    public static function fromJSONFile($file)
    {
        return new Node(json_decode(file_get_contents($file), true));
    }

    public static function fromRawFile($file)
    {
        return new Node(file_get_contents($file));
    }

}
