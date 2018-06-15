<?php

class OrdersModel extends Model {

    public function getOrderInfoByOrderId($orderId) {
        $result = array();
        $sql = "SELECT users.fullName, users.email, orders.amount, products.name, products.price FROM users
        INNER JOIN orders ON orders.user_id = users.id
        INNER JOIN productsInOrders ON orders.id = productsInOrders.order_id
        INNER JOIN products ON productsInOrders.product_id = products.id
        WHERE orders.id = :orderId";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderId", $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function deleteOrder($orderId) {
        $sql = "DELETE FROM productsInOrders WHERE order_id = :orderId;
                DELETE FROM orders WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderId", $orderId, PDO::PARAM_INT);
        $stmt->bindValue(":id", $orderId, PDO::PARAM_INT);
        $stmt->execute();      
    }





}