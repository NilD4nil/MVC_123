<?php
namespace app\core;

class View
{
    public $route;
    public $title;
    public $layout = 'default';

    public function __construct($route)
    {
        $this -> route = $route;
    }

    public function render($view, $params = [])
    {
        $path_view = 'app/views/' . $this -> route['controller'] . '/' . $view . '.php';
        if (file_exists($path_view)) {
            extract($params, EXTR_OVERWRITE);
            ob_start();
            require $path_view;
            $content = ob_get_clean();
            require 'app/views/layouts/' . $this->layout . '.php';
        } else{
            echo 'Вид не найден';
        }
    }
    public function redirect($url){
        header('location: '. $url);
        exit();
    }
    static public function errorCode($code){
        http_response_code($code);
        $path = 'app/views/errors' . $code . '.php';
        if(file_exists($path)){
            require $path;
        }
    exit();
    }
}