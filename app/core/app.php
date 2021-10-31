<?php

class App{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->urlParser();
        if(file_exists(CONTROLLER.$this->controller.".php")){
            require_once (CONTROLLER.$this->controller.".php");
                $this->controller = new $this->controller;
            if(method_exists($this->controller, $this->method)){
                call_user_func_array([$this->controller, $this->method], $this->params);
            } else {
                echo "404";
            }
        } else {
            echo "404";
        }
    }

    public function urlParser()
    {
        $request = trim($_SERVER["REQUEST_URI"], "/");
        if (!empty($request)){
            $url = explode("/", $request);
            $this->controller = isset($url[0]) ? $url[0]."Controller" : "HomeController";
            $this->method = $url[1] ?? "index";
            unset($url[0], $url[1]);
            $this->params = !empty($url) ? array_values($url) : [];
        } else {
            $this->controller = "HomeController";
            $this->method = "index";
            $this->params = array();
        }
    }
}