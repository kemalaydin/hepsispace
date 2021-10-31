<?php
session_start();
require_once("globals.php");
require_once(CORE . "app.php");

spl_autoload_register(function($class){
    $classPath = HOME . str_replace('\\', '/', $class) . ".php";
    if (is_readable($classPath)) {
        require_once $classPath;
    }
});


new App();