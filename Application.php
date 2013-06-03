<?php
require_once("config/config.php");

class Application {
    
    private static $_instance = null;
    public $db;
    private $twig;
    
    
    private function __construct(){
        
        $this->db = new PDO('pgsql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';user='.DB_USER.';password='.DB_PASSWD.'');
        
    }
    
    public static function getInstance() {
 
     if(is_null(self::$_instance)) {
       self::$_instance = new Application();  
     }
     return self::$_instance;
   }
}
?>
