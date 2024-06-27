<?php 

require_once '../src/models/Libro.php';



class LibrosController{


    private $model;


    public function __construct(){
        $this->model = new Libro();
        
    }


    public function get()
    {
        echo json_encode($this->model->all());
    }


}