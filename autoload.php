<?php
    require_once 'lib/Twig/Autoloader.php';
    //Twig_Autoloader::register();

    function __autoload($class){
        if(strpos($class,'Twig') === false){
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            require_once($path . '.php');
            echo "ok";
        }
    }
?>
