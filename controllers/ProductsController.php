<?php

class ProductsController extends Controller {

    private $pageTpl = "/views/products.tpl.php";
    private $productsPerPage = 5;

    public function __construct() {
        $this->model = new ProductsModel();
        $this->view = new View();
        $this->utils = new Utils();
    }

    public function index() {

        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        $allProducts = count($this->model->getAllProducts());
        $totalPages = ceil($allProducts / $this->productsPerPage);

        $this->makeProductPager($allProducts, $totalPages);

        $this->pageData['title'] = "Товары";

        $pagination = $this->utils->drawPager($allProducts, $this->productsPerPage);

        $this->pageData['pagination'] = $pagination;
        $this->view->render($this->pageTpl, $this->pageData);

        if($_FILES) {
            if($_FILES['csv']['type'] != 'text/csv' || $_FILES['csv']['type'] == '') {
                $this->pageData['errors'] = "Ошибка! Возможно данный файл имеет некорректный формат";
            } else {
                if(move_uploaded_file($_FILES['csv']['tmp_name'],UPLOAD_FOLDER.$_FILES['csv']['name'])) {
                    $file = fopen(UPLOAD_FOLDER.$_FILES['csv']['name'], "r");
                    $row = 1;
                    while($data = fgetcsv($file, 200, ";")) {
                        if($row == 1) {
                            $row++;
                            continue;
                        } else {
                            $this->model->addFromCSV($data);
                        }
                    }
                    fclose($file);
                    $this->model->getAllProducts();
                }
            }
        }
    }

    public function getProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
            return;
        }

        if(!isset($_GET['id'])) {
            echo json_encode(array("success" => false));
        } else {
            $productId = $_GET['id'];
            $productInfo = json_encode($this->model->getProductById($productId));
            echo $productInfo;
        }

    }

    public function saveProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
            return;
        }

        if(!isset($_POST['id']) || trim($_POST['name']) == '' || trim($_POST['price']) == '') {
            echo json_encode(array("success" => false, "text" => "Ошибка обновления данных"));
        } else {
            $productId = $_POST['id'];
            $productName = strip_tags(trim($_POST['name']));
            $productPrice = strip_tags(trim($_POST['price']));
            echo json_encode(array("success" => true, "text" => "Информация о товаре обновлена"));
        }
    }

    public function addProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
            return;
        }

        if(empty($_POST) || trim($_POST['productName']) == '' || trim($_POST['productPrice']) == '') {
            echo json_encode(array("success" => false, "text" => "Не удалось добавить товар"));
        } else {
            $productName = strip_tags(trim($_POST['productName']));
            $productPrice = strip_tags(trim($_POST['productPrice']));
            echo json_encode(array("success" => true, "text" => "Новый товар добавлен")); 
        }
    }

    public function deleteProduct() {
        if(!$_SESSION['user']) {
            header("Location: /");
            return;
        }

        if(empty($_POST) || !isset($_POST['id'])) {
            echo json_encode(array("success" => false));
        } else {
            $productId = $_POST['id'];
            if($this->model->deleteProduct($productId)) {
                echo json_encode(array("success" => true, "text" => "Товар удален"));
            } else {
                echo json_encode(array("success" => false, "text" => "Ошибка удаления товара"));
            }
        }
    }

    public function makeProductPager($allProducts, $totalPages) {
        if(!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->productsPerPage;
        } else if (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $this->productsPerPage * ($pageNumber-1);
            $rightLimit = $allProducts;
        } else {
            $pageNumber  = intval($_GET['page']);
            $leftLimit = $this->productsPerPage * ($pageNumber-1);
            $rightLimit = $this->productsPerPage;
        }

        $this->pageData['productsOnPage'] = $this->model->getLimitProducts($leftLimit, $rightLimit);
    }

}

 ?>
