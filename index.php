<?php
    global $getrau;
    $getrau = Application::getInstance();
    function __autoload($class){
        if(strpos($class,'Twig') === false){
            $path = str_replace('_', DIRECTORY_SEPARATOR, $class);
            
        }else{
            $path = "lib/".str_replace('_', DIRECTORY_SEPARATOR, $class);
        }
        require_once($path . '.php');
    }
    
    require_once 'routes.php';
    //require_once 'controllers/viewController.php';
    $pathWithParams = substr($_SERVER['REQUEST_URI'],7);
            $pathTab = explode("?",$pathWithParams);
            $path=$pathTab[0];
            //echo $path;
            $params=array();
            if(!empty($pathTab[1])){
                $urlParams=explode("&",$pathTab[1]);
                foreach ($urlParams as $urlParam){
                    $param = array();
                    $param2 = explode("=",$urlParam);
                    $params[$param2[0]] = $param2[1];
                }
                //print_r($params);
            }
    
    if(!empty($array[$path])){
        $controllerName = "Controller_".$array[$path]["controller"];
        $action = $array[$path]["action"];
    }else{
       $controllerName = "Controller_View";
       $action = "invalidPath";
    }
    //$controller = new $controllerName();
    
    if(!method_exists($controllerName, $action)){
        echo "404";
    }else{
        $controller = new $controllerName();
        if(empty($params)){
            $controller->$action();
        }else{
            $controller->$action($params);
        }
    }   
?>
