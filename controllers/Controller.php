<?php

class Controller {

    public $model;
    public $view;
    protected $pageData = array();

    public function __construct() {
        $this->view = new View();
        $this->model = new Model();
    }



}
