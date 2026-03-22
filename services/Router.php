<?php

namespace Services;

class Router {
    
    private $controller;
    private $method;
    
    public function __construct($page){
        
        $this -> controller = AVAILABLE_ROUTES[$page]['controller'];
        $this -> method = AVAILABLE_ROUTES[$page]['method'];
    }
    
    public function getController()
    {
        
        $instance = "Controllers\\".$this -> controller;
        
        $controller = new $instance();
        $method = $this -> method;
        
        
        $controller -> $method();
    }
    
}