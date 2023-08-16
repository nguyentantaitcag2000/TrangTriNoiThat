<?php
class Controller{

    public function model($model){
        require_once $_SERVER['DOCUMENT_ROOT']."/mvc/models/".$model.".php";
        return new $model;
    }

    public function view($view, $data=[]){
        require_once $_SERVER['DOCUMENT_ROOT']."/mvc/views/".$view.".php";
    }

}
?>