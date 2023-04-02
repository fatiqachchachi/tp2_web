<?php
require_once("/var/www/html/WEB/TP2/app/config/config.php");
abstract class Controller{
    public function loadModel(string $model){
        require_once(ROOT . 'models/' . $model . ' .php');
        return new $model();
    }
    public function render($vue, array $data =[]){
        //var_dump($data);
        if(!empty($data))
            extract($data);

        ob_start();

        require_once(ROOT . 'views/' . strtolower(get_class($this)) . '/' .$vue . '.php' ); 
        $content = ob_get_clean();

    }
}
?>