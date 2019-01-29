<?php

/**
 * Класс маршрутизации
 ** Урл http://cabinet.codetogether.ru/
 ** Урл http://cabinet.codetogether.ru/cabinet
 ** Урл http://cabinet.codetogether.ru/cabinet/users
 ** Урл http://cabinet.codetogether.ru/cabinet/orders
 ** Урл http://cabinet.codetogether.ru/orders?orderId=
 */
class Routing {

    public static function buildRoute() {


        /* Контроллер и action по умолчанию */
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";
        $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $i = count($route)-1;

        while($i>0) {
            if($route[1] != 'cabinet') {
                header('Location: /cabinet');
            }
            if($route[$i] != '') {
                if(is_file(CONTROLLER_PATH . ucfirst($route[$i]) . "Controller.php")) {
                    $controllerName = ucfirst($route[$i]) . "Controller";
                    $modelName =  ucfirst($route[$i]) . "Model";
                    break;
                } else {
                    $action = $route[$i];
                }
            }
                $i--;
            }
            require_once CONTROLLER_PATH . $controllerName . ".php";
            require_once MODEL_PATH . $modelName . ".php";
            
            $controller = new $controllerName();
            
            if(method_exists($controller, $action)) {
                $controller->$action();
            } else {
                self::errorPage();
            }
    }

    public static function errorPage() {
        header("Location: /404.php");
    }

}
