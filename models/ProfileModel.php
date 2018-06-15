<?php

class ProfileModel extends Model {

    public function getAccountInfo($id) {
        $result = array();
        $sql = "SELECT users.id, users.login, users.fullName, users.email, role.name FROM users
                INNER JOIN role ON users.role_id = role.id
                WHERE users.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateProfile($profileId, $profileLogin, $profileEmail) {
        $sql = "UPDATE users
                SET login = :login, email = :email
                WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $profileLogin, PDO::PARAM_STR);
        $stmt->bindValue(":email", $profileEmail, PDO::PARAM_STR);
        $stmt->bindValue(":id", $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public function updatePassword($profileId, $newPassword) {
        $sql = "UPDATE users
                SET password = :password
                WHERE id = :id
        ";
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(":password", $newPassword, PDO::PARAM_STR);
         $stmt->bindValue(":id", $profileId, PDO::PARAM_INT);
         $stmt->execute();
         return true;
    }
}