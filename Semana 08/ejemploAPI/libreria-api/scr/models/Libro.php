<?php 

/// archivos configuracion de la base de datos.
require_once '../src/db/Database.php';

class Libro{

    private $db;
    public function __construct(){
        $this->db = Database::connect();

    }


    public function all(){
        $stmt = $this->db->query("select * from libros");
        return $stmt->fetchAll();
    }
}