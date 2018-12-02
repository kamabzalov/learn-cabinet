<?php 

class NewsController extends Controller{

    private $pageTpl = "/views/news.tpl.php";

    public function __construct() {
        $this->model = new NewsModel();
        $this->view = new View();
    }

    public function index () {

        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        $this->pageData['title'] = "Новости";
        $news = $this->model->getNews();
        $this->pageData['news'] = $news;
        
        $this->view->render($this->pageTpl, $this->pageData);
    }


    public function getNewsById() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(isset($_POST['id'])) {
            $newsId = $_POST['id'];
            if($newsInfo = $this->model->getNewsById($newsId)) {
                echo json_encode($newsInfo);
            } else {
                echo json_encode(array("success" => false, "text" => "Новост не найдена"));
            }
        } else {
            echo json_encode(array("success" => false, "text" => "Произошла ошибка. Обратитесь к вашему программисту или попробуйте позже"));
        }        

    }

    public function save() {
        
        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['title']) && !empty($_POST['text'])) {
            $newsId = $_POST['id'];
            $newsTitle = trim(strip_tags($_POST['title']));
            $newsText =  trim(strip_tags($_POST['text']));
            $this->model->saveNews($newsId, $newsTitle, $newsText);
            echo json_encode(array("success" => true, "text" => "Новость сохранена"));
        } else {
            echo json_encode(array("success" => false, "text" => "Ошибка. Заполните все поля"));
        }

    }
}