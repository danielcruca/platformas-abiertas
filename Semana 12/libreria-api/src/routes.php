<?php
require_once 'controllers/AutoresController.php';
require_once 'controllers/LibrosController.php';
require_once 'controllers/TransaccionesController.php';

$method = $_SERVER['REQUEST_METHOD'];


// remueve / del inicio
// /autores/1 -> autores/1
$path = trim($_SERVER['PATH_INFO'], '/');
// Split the path into segments
// con EXPLODE: Separamos en secciones el URL(string) por medio del / y conviertiendo en un arreglo
// autores/1 -> autores/1
$segmentosDeUrl = explode('/', $path);

/*
var_dump($_SERVER['PATH_INFO']);
var_dump($path);
var_dump($segments);*/


// Obtiene el primer elemento del arreglo
$rutaControlador = array_shift($segmentosDeUrl );
// Obtiene el ultimo
$id = end($segmentosDeUrl );

if($rutaControlador == "prueba") {

    switch ($method) {
        case 'GET':
            echo json_encode(['Alert' => 'LLamando get de prueba']);
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}

elseif ($rutaControlador == "autores") {
   

    $objAutores  = new AutoresController();

    switch ($method) {
        case 'GET':
            $objAutores->get($id);
            break;
        case 'POST':
            $objAutores->post();
            break;
        case 'PUT':
            $objAutores->put($id);
            break;
        case 'DELETE':
            $objAutores->delete($id);
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
   
}

elseif($rutaControlador == "libros")
{

    /// modelo -> controller -> llamarlo desde routes
    $objetoLibros  = new LibrosController();

    switch ($method) {
        case 'GET':
            $objetoLibros->get($id);
            break;
        case 'POST':
            $objetoLibros->crear();
           // $objetoLibros->post();
            break;
        case 'PUT':
            $objetoLibros->actualizar($id);
            break;
        case 'DELETE':
            /// http://localhost/api/libreria-api/public/index.php/libros/7
            $objetoLibros->eliminar($id);
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}
elseif($rutaControlador == "transaccion")
{
    $objetoLibros  = new TransaccionesController();

    switch ($method) {
        case 'GET':
            $objetoLibros->get($id);
            break;
        case 'POST':
            $objetoLibros->post();
            break;
        case 'PUT':
            $objetoLibros->put($id);
            break;
        case 'DELETE':
            $objetoLibros->delete($id);
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}
else{
    include "error/response.html";
}



?>
