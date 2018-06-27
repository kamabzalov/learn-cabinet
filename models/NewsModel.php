<?php

class NewsModel extends Model {

    public function getNews() {
        $sql = "SELECT * FROM news";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    public function getNewsById($id) {
        $result = array();
        $sql = "SELECT * FROM news WHERE id= :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($result)) {
            return false;
        } else {
            return $result;
        }

    }

    public function saveNews($id, $title, $text) {

        $sql = "UPDATE news
                SET title = :title, description = :text
                WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":text", $text, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();

    }


}