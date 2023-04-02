<?php
class Core{
    protected $currentController = 'page';
    protected $currentMethod = 'index';
    protected $params=[];

    public function __construct(){
        $url = $this->getUrl();

        if (isset($url[0])) {
            $this->currentController = $url[0];
        }
        if (isset($url[1])) {
            $this->currentMethod = $url[1];
        }

        unset($url[0], $url[1]);
        $this->params = $url ? array_values($url) : [];
        $controllerName = ucfirst($this->currentController);
        $controllerFile = 'controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            $controller = new $controllerName;
            $method = $this->currentMethod;
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $this->params);
            } else {
                echo "Method $method not available!";
            }
        } else {
            echo "Controller $controllerName not found!";
        }
    }

    public function getUrl(){
        var_dump($_SERVER['QUERY_STRING']);
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            return explode('/', $url);
        }
    }
}
