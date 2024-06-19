<?php

$method = $_SERVER['REQUEST_METHOD'];

// remueve / del inicio

$path = trim($_SERVER['PATH_INFO'], '/');
// PATH_INFO



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

if($rutaControlador == "prueba") {

    switch ($method) {
        case 'GET':
            echo json_encode(['Alert' => 'LLamando get de prueba']);
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}

else{
    include "error/response.html";
}



?>
