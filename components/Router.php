<?php

class Router {
    private $routes;

    public function __construct() {
        $this->routes = include ROOT . '/config/routes.php';
    }
    
    /*
     * Return request string;
     */
    private function getUri(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        $uri = $this->getUri();

        foreach ($this->routes as $uriPattern => $path){

            if(preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);

                //array_shift($segments); // если проект находится в корне, то данная строчка не нужна!
                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if(file_exists($controllerFile)){
                    include_once $controllerFile;
                }

                $objController = new $controllerName;
            //    $actionResult = $objController->$actionName($parameters); //то же самое, что и следующая строка, но здесь параметры передаются массивом, а в следующей строке переменными;
                $actionResult = call_user_func_array(array($objController, $actionName), $parameters);

                if($actionResult != null){
                    break;
                }
            }
        }
        
        
    }
    
}
