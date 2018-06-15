<?php

class IndexModel extends Model {

    public function checkUser() {
        $login = strip_tags($_POST['login']);
        $password = md5(strip_tags($_POST['password']));

        $sql = "SELECT * FROM users WHERE login = :login AND password = :password";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);


        if(!empty($res)) {
            $_SESSION['user'] = strip_tags($_POST['login']);
            $_SESSION['userId'] = $res['id'];
            $_SESSION['role_id'] = $res['role_id'];
            header("Location: /cabinet");
        } else {
            return false;
        }
    }

    public function registerNewUser($regUser, $regLogin, $regEmail, $regPassword) {
        $sql = "INSERT INTO users(fullName, login, email, password, role_id)
                VALUES (:login, :fullName, :email, :password, 2)   
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":fullName", $regUser, PDO::PARAM_STR);
        $stmt->bindValue(":login", $regLogin, PDO::PARAM_STR);
        $stmt->bindValue(":email", $regEmail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $regPassword, PDO::PARAM_STR);
        $stmt->execute();
    }
}
