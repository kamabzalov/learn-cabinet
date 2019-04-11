<?php

class ProfileController extends Controller {

    private $pageTpl = "/views/profile.tpl.php";

    public function __construct() {
        $this->model = new ProfileModel();
        $this->view  = new View();
    }

    public function index() {
        if(!$_SESSION['user']) {
            header("Location: /");
        }

        $userId = $_SESSION['userId'];
        $this->pageData['title'] = "Мой аккаунт";
        $userInfo = $this->model->getAccountInfo($userId);
        $this->pageData['userInfo'] = $userInfo;
        $this->view->render($this->pageTpl, $this->pageData);

    }

    public function updateProfile() {
        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        if(empty($_POST) || !isset($_POST['login']) || !isset($_POST['email'])) {
            echo json_encode(array("success" => false, "text" => "Ошибка при обновлении"));
        } else {
            $this->model->updateProfile($profileId, $profileLogin, $profileEmail);
            echo json_encode(array("success" => true, "text" => "Данные изменены"));
        }
    }

    public function updatePassword() {
        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        if(empty($_POST) || !isset($_POST['newpass']) || !isset($_POST['repeatpass'])) {
            echo json_encode(array("success" => false, "text" => "Ошибка ввода пароля"));
        } else {  
            $profileId = $_POST['id'];
            $newPass = strip_tags($_POST['newpass']);
            $repeatNewPass = strip_tags($_POST['repeatpass']);
            if($newPass != $repeatNewPass) {
                echo json_encode(array("success" => false, "text" => "Пароли не совпадают"));
                return;
            }
            $this->model->updatePassword($profileId, md5($newPass));
            echo json_encode(array("success" => true, "text" => "Вы успешно изменили ваш пароль"));
        }      
    }

}
