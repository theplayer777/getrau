<?php

require_once("config/config.php");

class Error {

    private static $_instance = null;
    private $errors;
    private $file;

    private function __construct() {
        $this->errors = array();
        $this->file = ERROR_FILE;
    }

    public static function getInstance() {

        if (is_null(self::$_instance)) {
            self::$_instance = new Error();
        }
        return self::$_instance;
    }

    public function addError($error) {
        array_push($this->errors, $error);
        if (!file_exists($this->file)) {
            $fp = fopen($this->file, "\n");
            fwrite($fp, "0");
            fclose($fp);
        }
        $current = file_get_contents($this->file);
        $current_date = date('m/d/Y -- H:i:s');
        $current .=$current_date . " " . $error . "\n";
        file_put_contents($this->file, $current);
    }

    public function noError() {
        if (empty($this->errors)) {
            return true;
        } else {
            //$this->resetErrors();
            return false;
        }
    }
    
    private function resetErrors(){
        $this->errors = array();
    }
    
    public function getLastError(){
        return end($this->errors);
    }

}

?>
