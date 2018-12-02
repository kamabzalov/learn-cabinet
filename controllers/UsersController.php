<?php

class UsersController extends Controller{

    private $pageTpl = "/views/users.tpl.php";
    private $mailTpl = "/views/mail/newUser.tpl.html";

    public function __construct() {
        $this->model = new UsersModel();
        $this->view = new View();
    }

    public function sendRegisterEmail($fullName, $login, $password, $email) {

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $emailText = file_get_contents(ROOT . $this->mailTpl);
        $emailText = str_replace('%fullName%', $fullName, $emailText);
        $emailText = str_replace('%login%', $login, $emailText);
        $emailText = str_replace('%password%', $password, $emailText);
        $emailText = str_replace('%email%', $email, $emailText);

        mail($email, "Для вас создана учетная запись", $emailText, $headers);

    }

    public function index() {

        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        $this->pageData['permission'] = $_SESSION['role_id'];

        $this->pageData['title'] = "Пользователи";
        $this->pageData['usersList'] = $this->model->getUsers();
        $this->view->render($this->pageTpl, $this->pageData);

    }

    public function getUserById() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(isset($_POST['id']) && $_POST['id'] != '') {
            $userId = $_POST['id'];
            $userInfo = json_encode($this->model->getUserById($userId));
            echo $userInfo;

        } else {
            echo json_encode(array("success" => false, "text" => "Ошибка"));
        }
    }

    public function getUsersRoles() {
        
        if(!$_SESSION['user']) {
            header("Location: /");
        }

        $roles = $this->model->getUsersRoles();
        if(empty($roles)) {
            echo json_encode(array("success" => false, "text" => "Ошибка"));
        } else {
            echo json_encode($roles);
        }

    }  

    public function updateUserData() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['id']) && !empty($_POST['fullName']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['role'])) {
            $userId = $_POST['id'];
            $userFullName = strip_tags(trim($_POST['fullName']));
            $userLogin = strip_tags(trim($_POST['login']));
            $userEmail = strip_tags(trim($_POST['email']));
            $userRole = $_POST['role'];
            $this->model->updateUserInfo($userId, $userFullName, $userLogin, $userEmail, $userRole);
            echo json_encode(array("success" => true, "text" => "Данные пользователя сохранены"));    
        } else {
            echo json_encode(array("success" => false, "text" => "Заполните все данные"));
        }

    }

    public function deleteUser() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['id'])) {
            $userId = $_POST['id'];
            $this->model->deleteUser($userId);
            echo json_encode(array("success" => true, "text" => "Пользователь успешно удален"));
        } else {
            echo json_encode(array("success" => false, "text" => "Произошла ошибка. Попробуйте позже"));
        }
    }

    public function addNewUser() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['fullName']) && !empty($_POST['password']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['role'])) {
            $newUser = strip_tags(trim($_POST['fullName']));
            $newLogin = trim(strip_tags($_POST['login']));
            $newEmail = strip_tags(trim($_POST['email']));
            $newPassword = strip_tags(trim(md5($_POST['password'])));
            $passwordForEmail = strip_tags(trim($_POST['password']));
            $newRole = $_POST['role'];
            $this->model->addNewUser($newLogin, $newUser, $newEmail, $newPassword, $newRole);
            echo json_encode(array("success" => true, "text" => "Новый пользователь добавлен")); 
            $this->sendRegisterEmail($newUser, $newLogin, $passwordForEmail, $newEmail);   
        } else {
            echo json_encode(array("success" => false, "text" => "Заполните все данные"));
        }

    }

}
