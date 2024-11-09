<?php

require_once "../src/controllers/LibrosController.php";
require_once "../src/utils/Auth.php";
//http://localhost/libreria-api/public/index.php/saludo

// Crea una instancia de Auth
$auth = new Auth();
$auth->verificarToken();


$method = $_SERVER["REQUEST_METHOD"];
$path = trim($_SERVER["PATH_INFO"], '/');
$segmentos = explode("/", $path);
$queryString = $_SERVER['QUERY_STRING'];
parse_str($queryString, $queryParams);



if($path == "libros")
{
    $librosController = new librosController();
    switch($method) {
        
        case  'GET':
            // http://localhost/libreria-api/public/index.php/libros?id=1
            // http://localhost/libreria-api/public/index.php/libros
            // Extraemos los parámetros de la consulta
            $id = isset($queryParams['id']) ? $queryParams['id'] : null;
        

           if($id != null)
           {
              $librosController->ObtenerPorId($id);
           }
           else
           {
            $librosController->ObtenerTodos();
           }
            break;
        
        case 'POST':

            //http://localhost/libreria-api/public/index.php/libros
            $librosController->crear();

            break;

        case 'DELETE':
            //http://localhost/libreria-api/public/index.php/libros?id=1
            $id = isset($queryParams['id']) ? $queryParams['id'] : null;
            $librosController->eliminar($id);
            break;

        case 'PUT':
            //http://localhost/libreria-api/public/index.php/libros?id=1
            $id = isset($queryParams['id']) ? $queryParams['id'] : null;
            $librosController->actualizar($id);
            break;
        default:
            echo json_encode(["Error" => "Metodo no implementado todavia para libros." ]);

    }

}


if($path == "saludo")
{

    switch($method) {
        case  'GET':

            if($nombre != "")
            {
              // echo "Saludo ". $nombre;
                echo json_encode(['Alert' => 'LLamando get de prueba2']);
            }
            else
            {
                echo json_encode(['Alert' => 'LLamando get de prueba3']);
            }
          
            break;

        default:
            echo "Metodo no implementado todavia para saludo.";


    }

}



if($path == "reportes")
{

    switch($method) {
        case  'GET':

         
            echo json_encode(["Resultado" =>  "top 5 marcas"]);
          
            break;

        default:
            echo json_encode(["Error" => "llamando al get de libros" ]);

    }

}


?>
