<?php
require_once '../src/utils/Token.php'; 

// Auth.php
class Auth {
  
    public static function verificarToken() {
        $headers = apache_request_headers();
        
        // Verifica que el encabezado de autorización esté presente
        if (!isset($headers['Authorization'])) {
            echo json_encode(value: ["Resultado" =>   'No autorizado: encabezado de autorización faltante']);
            exit();
        }

        // Extrae el token del encabezado y lo compara con el token definido
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        if ($token !== API_TOKEN) {
            echo json_encode(value: ["Resultado" =>  'Token no válido']);
            exit();
        }
    }

}
