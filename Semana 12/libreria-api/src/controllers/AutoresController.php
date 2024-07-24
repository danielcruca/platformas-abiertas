<?php
require_once '../src/models/Autor.php';

class AutoresController {
    private $modeloAutores;

    public function __construct() {
        $this->modeloAutores = new Autor();
    }

    public function get() {
      
         echo json_encode($this->modeloAutores->all());
   
    }

    /*
        public function get($id = null) {
        if ($id) {
            echo json_encode($this->modeloAutores->find($id));
        } else {
            echo json_encode($this->modeloAutores->all());
        }
    }
    */

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->modeloAutores->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->modeloAutores->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->modeloAutores->delete($id));
    }
}
?>
