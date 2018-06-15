<?php

class IndexController extends Controller{

    private $pageTpl = "/views/main.tpl.php";

    public function __construct() {
        $this->model = new IndexModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = "Вход в личный кабинет";
        if(!empty($_POST)) {
            $action = $_POST['action'];
            switch($action) {
                case 'login':
                    if(!$this->login()) {
                        $this->pageData['loginError'] = "Неверный логин или пароль";
                    }
                    break;
                case 'register':
                    if($this->register()) {
                        $this->pageData['registerMsg'] = "Вы успешно зарегистрированы. Авторизуйтесь.";
                    } else {
                        $this->pageData['registerMsg'] = "Произошла ошибка во время регистрации";
                    }
                    break;    
            }
        }
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function login() {
        if(!$this->model->checkUser()) {
            return false;
        }
    }

    public function register() {
        if(!empty($_POST) && !empty($_POST['fullName']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $regUser = strip_tags($_POST['fullName']);
            $regLogin = strip_tags($_POST['login']);
            $regEmail = strip_tags($_POST['email']);
            $regPassword = md5(strip_tags($_POST['password']));
            $this->model->registerNewUser($regUser, $regLogin, $regEmail, $regPassword);
            return true;
        } else {
            $this->pageData['registerMsg'] = "Вы заполнили не все поля";
            return false;
        }
    }

}
