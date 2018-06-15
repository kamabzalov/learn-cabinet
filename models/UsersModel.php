<?php

class UsersModel extends Model {

    public function getUsers() {
        $sql = "SELECT users.id, users.login, users.fullName, users.email, role.name as role FROM users
                INNER JOIN role ON users.role_id = role.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    public function getUserById($userId) {
        $sql = "SELECT users.id, users.email, users.fullName, users.login, role.name as role FROM users
                INNER JOIN role ON users.role_id = role.id
                WHERE users.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)) {
            return $result;
        } else {
            return false;
        }
        
    }

    public function getUsersRoles() {
        $result = array();
        $sql = "SELECT * FROM role";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function updateUserInfo($userId, $userFullName, $userLogin, $userEmail, $userRole) {
        $sql = "UPDATE users
                SET login = :login, fullName = :fullName, email = :email, role_id = :roleId
                WHERE id = :id    
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $userLogin, PDO::PARAM_STR);
        $stmt->bindValue(":fullName", $userFullName, PDO::PARAM_STR);
        $stmt->bindValue(":email", $userEmail, PDO::PARAM_STR);
        $stmt->bindValue(":roleId", $userRole, PDO::PARAM_INT);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return true;        
    }

    public function addNewUser($userLogin, $userFullName, $userEmail, $userPassword, $userRole) {
        $sql = "INSERT INTO users(login, fullName, email, password, role_id)
                VALUES (:login, :fullName, :email, :password, :role_id)   
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $userLogin, PDO::PARAM_STR);
        $stmt->bindValue(":fullName", $userFullName, PDO::PARAM_STR);
        $stmt->bindValue(":email", $userEmail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $userPassword, PDO::PARAM_STR);
        $stmt->bindValue(":role_id", $userRole, PDO::PARAM_INT);
        $stmt->execute();
        return true;        
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }


}
