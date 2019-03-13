<?php 

ob_start();
session_start();

// database config 
define('DBHOST','127.0.0.1');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','phpblog');

$database = new mysqli(DBHOST, DBUSER, DBPASS,DBNAME);

// set timezone 
date_default_timezone_set('America/Toronto');

//load classes as needed
function __autoload($class) {
   
   $class = strtolower($class);

   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }     

   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }
        
     
}

$user = new User($database); 

?>