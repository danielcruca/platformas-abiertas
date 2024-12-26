<?php

require_once '../src/db/Database.php';

class Auth {

    private $db;

    public function __construct(){
        // Inicializa la conexión a la base de datos
        $this->db = new Database();
    }

    /**
     * Verifica si el token enviado es válido y no ha expirado.
     */
    public function verificarToken() {
        // Obtiene los encabezados de la solicitud
        $headers = apache_request_headers();

        // Verifica si el encabezado Authorization está presente
        if (!isset($headers['Authorization'])) {
            echo json_encode(["Resultado" => 'No autorizado: encabezado de autorización faltante']);
            exit();
        }

        // Extrae el token del encabezado y lo valida
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        if (!$this->esTokenValido($token)) {
            echo json_encode(["Resultado" => 'Token no válido o expirado']);
            exit();
        }
    }

    /**
     * Verifica si el token es válido y no ha expirado.
     *
     * @param string $token El token a verificar
     *
     * @return bool True si el token es válido y no ha expirado, false en caso contrario
     */
    private function esTokenValido($token) {
        // Realiza una consulta a la base de datos para verificar si el token existe y no ha expirado
        $stmt = $this->db->connect()->prepare("SELECT * FROM tokens WHERE token = ? AND expires_at > NOW()");
        $stmt->execute([$token]);
        $tokenData = $stmt->fetch();

        return $tokenData ? true : false; // Retorna true si el token es válido
    }
}
