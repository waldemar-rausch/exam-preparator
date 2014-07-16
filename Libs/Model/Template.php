<?php

class Libs_Template
{
    protected $template;
    protected $variables = array();

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function __get($key)
    {
        return $this->variables[$key];
    }

    public function __set($key, $value)
    {
        $this->variables[$key] = $value;
    }
}