<?php
class System
{
    protected  $controller;
    protected  $method;

    public function __construct()
    {
        $this->controller = "home";
        $this->method = "index";

        if(isset($_GET['act'])) {
            $url = explode('/',filter_var(rtrim($_GET['act'],'/'),FILTER_SANITIZE_URL));
        } else {
           $url[0] = $this->controller;
           $url[1] = $this->method;
        }

        if(file_exists(CONTROLLERS_PATH."/".$url[0].".php")) {
            $this->controller = $url[0];
        }
        require_once CONTROLLERS_PATH . "/" . $this->controller . ".php";
        if(class_exists($this->controller)) {
            $this->controller = new $this->controller;
            array_shift($url);
        } else {
            exit($this->controller." class'ı bulunamadı");
        }
        if(isset($url[0])) {
            if(method_exists($this->controller,$url[0])) {
                $this->method = $url[0];
                array_shift($url);
            } else {
                exit($url[0]." Method Bulunamadı");
            }
        }
        call_user_func_array([$this->controller,$this->method],$url);
    }
}