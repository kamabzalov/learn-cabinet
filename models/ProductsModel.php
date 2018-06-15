<?php

class ProductsModel extends Model {

    public function getAllProducts() {
        $result = array();
        $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    public function getLimitProducts($leftLimit, $rightLimit) {
        $result = array();
        $sql = "SELECT * FROM products LIMIT :leftLimit, :rightLimit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":leftLimit", $leftLimit, PDO::PARAM_INT);
        $stmt->bindValue(":rightLimit", $rightLimit, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }

    public function addFromCSV($data) {
        $sql = "INSERT INTO products(name, price) VALUES(:name, :price)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $data[0], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data[1], PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getProductById($id) {
        $result = array();
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function saveProductInfo($id, $name, $price) {
        $sql = "UPDATE products
                SET price = :price, name = :name
                WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }


    public function addProduct($productName, $productPrice) {
        $sql = "INSERT INTO products(name, price)
                VALUES(:productName, :productPrice)
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productName", $productName, PDO::PARAM_STR);
        $stmt->bindValue(":productPrice", $productPrice, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0) {
            return true;
        } else {
            return false;
        }

    }

}

 ?>
