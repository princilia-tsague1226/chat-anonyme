<?php

namespace Services;

require "./configs/settings.php";

class Router {
    
    private $controller;
    private $method;
    
    public function __construct($page){
        
        $this -> controller = AVAILABLE_ROUTES[$page]['controller'];
        $this -> method = AVAILABLE_ROUTES[$page]['method'];
    }
    
    public function getController()
    {
        // récupérer le nom du controller 
        $instance = "Controllers\\".$this -> controller;
        
        $controller = new $instance();
        $method = $this -> method;
        
        // appeller la bonne méthode 
        $controller -> $method();
    }
    
}