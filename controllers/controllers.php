<?php

include('view/view.php');
include('models/models.php');

class Controllers
{
    private $getChoice;
    private $view;
    private $model;
        
    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->getChoice = (!empty($_GET))?$_GET:array('action'=>'home');
        $this->paramPost = (!empty($_POST))?$_POST:null;
    }
    
    public function dispatch()
    {
        if ($this->paramPost) {
            $method = $this->paramPost['action'];
            $this->model->$method($this->paramPost);
        }
        
        switch ($this->getChoice['action']) {
            case "home":
                $this->view->displayHome();
                break;
            case "list":
                $list=$this->model->getList();
                $this->view->displayList($list);
                break;
            case "add":
                // $this->model->add($this->parmForm);
                $this->view->displayAdd();
                break;
            case "update":
                $this->view->displayUpdate($this->getChoice);
                break;
            case "delete":
                $this->view->displayDelete($this->getChoice);
                break;
            default:
                $this->view->displayHome();
            }
    }
}