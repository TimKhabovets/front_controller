<?php 

class Router {
    private $routes;

    function __construct() {
        $routesPath = ROOT.'\config\routes.php';
        $this->routes = include($routesPath); 
    }

    // return query string
    private function getURI() {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        
        // get query string
        $uri = $this->getURI();
        $uri = substr($uri, 8);
        
        // check availability query in routes.php
        foreach ($this->routes as $uriPattern => $path) {

            //compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // get inner path from outer
                $internalRout = preg_replace("~$uriPattern~", $path, $uri);

                // determine controller and action 
                $segments = explode('/', $internalRout);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;
                
                // include controller file
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                
                if (file_exists($controllerFile)) {
                    include_once($controllerFile); 
                }

                // create object and call method(action)
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result != null) {
                    break;
                }
            }
        }
    }
}
