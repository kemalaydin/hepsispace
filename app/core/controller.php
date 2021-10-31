<?php
require_once(CORE . "view.php");

class Controller{
    protected $view;

    public function view($view)
    {
        $this->view = new View($view);
        return $this->view->Render();
    }

    public function redirect($path)
    {
        header("Location: {$path}");
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isMethod($method)
    {
        if($this->method() == $method) {
            return true;
        }else{
            return false;
        }
    }

    public function methodParams()
    {
        return $_REQUEST;
    }
}