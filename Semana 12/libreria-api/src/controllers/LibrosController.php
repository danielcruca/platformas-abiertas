<?php
require_once '../src/models/Libro.php';

class LibrosController {
    private $model;

    public function __construct() {
        $this->model = new Libro();
    }

    public function get($id) {

        if($id){
            echo  json_encode($this->model->buscarPorID($id));
        
        }
        else{
            echo json_encode($this->model->obtenerTodos());
           
        }
        // echo json_encode($this->model->all());

    }
  /*
    public function get($id = null) {
        if ($id) {
            echo json_encode($this->model->find($id));
        } else {
            echo json_encode($this->model->all());
        }
    }*/

    public function crear(){
       $data = json_decode(file_get_contents('php://input'), true);
       /*  var_dump($data);
        if(intval($data["precio"] > 0))
        {
            echo "precio mayor a 0";
        }
        else
        {
            echo "precio no puede ser menor a  0";
        }*/

        echo  json_encode($this->model->crear($data));

    }
    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->update($id, $data));
    }

    public function actualizar($id){
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->actualizar($id, $data));
    }

    public function eliminar($id)
    {
   
         echo json_encode($this->model->eliminar($id));

    }


    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }
}
?>
