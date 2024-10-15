<?php 

//END POINT PRINCIPAL: http://localhost/libreria-api/public/index.php/holamundo
// END POINT CON UN PARAMETRO: http://localhost/libreria-api/public/index.php/holamundo?nombre=Daniel



/// AQUI EMPIEZA LA LOGICA DE LA API.
 
 

// Manejo de la ruta.
$method = $_SERVER['REQUEST_METHOD'];
//var_dump($method ); //get
// remueve / del inicio




$path = trim($_SERVER['PATH_INFO'], characters: '/');


// Divide la ruta por "/" para obtener el endpoint y el posible parámetro.
$segments = explode('/', $path);

//var_dump($_SERVER);


// Captura la cadena de consulta completa después del "?" (por ejemplo: "id=123&nombre=juan")
$queryString = $_SERVER['QUERY_STRING'];
// Parseamos la cadena de consulta a un arreglo asociativo.
parse_str($queryString, $queryParams);


// Extraemos los parámetros de la consulta
$nombre = isset($queryParams['nombre']) ? $queryParams['nombre'] : null;

var_dump($nombre);

if($path  == "holamundo") {

    switch ($method) {
        case 'GET':

            if($nombre != "")
            {
                echo json_encode(['Alert' => 'Hola: '. $nombre]);
            }
            else
            {
                echo json_encode(['Alert' => 'LLamando get sin parametros']);
            }
           
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}
else{
    include "error/response.html";
}



?>
