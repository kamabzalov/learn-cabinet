<?php

class OrdersController extends Controller {

    private $pageTpl = "/views/order.tpl.php";
    private $mailTpl = "/views/mail/checkOrder.tpl.html";

    public function __construct() {
        $this->model = new OrdersModel();
        $this->view = new View();
    }

    public function sendCheckOrderMail($fullName, $email, $amount, $products, $prices) {

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $emailText = file_get_contents(ROOT . $this->mailTpl);
        $emailText = str_replace('%fullName%', $fullName, $emailText);
        $emailText = str_replace('%amount%', $amount, $emailText);
        $emailText .= "<ul style='margin:0; padding:0'>";
        for($i=0; $i<count($products); $i++) {
            $emailText .= "<li>" . $products[$i] . " - " . $prices[$i] . "</li>";
        }
        $emailText .= "</ul>";

        mail($email, "Ваш заказ одобрен", $emailText, $headers);

    }

    public function index() {
        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }
        
        $this->pageData['title'] = "Детали заказа";
        if(isset($_GET['orderId'])) {
            $orderId = intval($_GET['orderId']);
            if($orderId > 0) {
                $this->pageData['orderInfo'] = $this->model->getOrderInfoByOrderId($orderId);
            } 
        }
        $this->view->render($this->pageTpl, $this->pageData);
        
    }
    
    public function checkOrder() {
        if(isset($_POST['id'])) {
            $orderId = $_POST['id'];
            $orderInfo = $this->model->getOrderInfoByOrderId($orderId);
            $fullName = $orderInfo[0]['fullName'];
            $email = $orderInfo[0]['email'];
            $amount = $orderInfo[0]['amount'];
            $productsArr = array();
            $productsPricesArr = array();
            foreach($orderInfo as $item) {
                array_unshift($productsArr, $item['name']);
                array_unshift($productsPricesArr, $item['price']);
            }
            $this->sendCheckOrderMail($fullName, $email, $amount, $productsArr, $productsPricesArr);
            echo json_encode(array("success" => true, "text" => "Заказ одобрен"));
        } else {
            echo json_encode(array("success" => true, "text" => "Ошибка"));
        }
    }

    public function deleteOrder() {
        if(isset($_POST['id'])) {
            $orderId = $_POST['id'];
            $this->model->deleteOrder($orderId);
            echo json_encode(array("success" => true, "text" => "Заказ удален"));
        } else {
            echo json_encode(array("success" => true, "text" => "Не удалось удалить заказ"));
        }
    }

}

 ?>
