<?php

class View {
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function Render(): Void{
        if(file_exists(VIEW.$this->file.".php")){
            ob_start();
            ob_get_clean();
            include_once (VIEW.$this->file.".php");
        }
    }
}