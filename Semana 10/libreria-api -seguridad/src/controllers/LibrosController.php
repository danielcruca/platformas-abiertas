<?php


require_once '../src/models/Libros.php';



class LibrosController{

 
    public function ObtenerTodos(){
        $modeloLibro = new Libros();
        echo json_encode(value: ["Resultado" =>   $modeloLibro->getAll()]);
    }

    public function ObtenerPorId($id){
        $modeloLibro = new Libros();
        echo json_encode(value: ["Resultado" =>   $modeloLibro->getById($id)]);


    }

    public function crear()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $modeloLibro = new Libros();
        echo json_encode(value: ["Resultado" =>   $modeloLibro->create($data)]);
        
    }


    public function eliminar($id)
    {
        $modeloLibro = new Libros();
        echo json_encode(value: ["Resultado" =>   $modeloLibro->delete($id)]);
        
    }

    public function actualizar($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $modeloLibro = new Libros();        
        echo json_encode(value: ["Resultado" =>   $modeloLibro->update($id,$data)]);
        
    }
}